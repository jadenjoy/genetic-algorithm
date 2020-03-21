<?php

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\CrossoverInterface;
use Darvin\GeneticAlgorithm\Contracts\MutationInterface;
use Darvin\GeneticAlgorithm\Contracts\PoolSelectionInterface;
use Darvin\GeneticAlgorithm\Contracts\SettingsInterface;
use Darvin\GeneticAlgorithm\Contracts\PopulationInterface;
use Darvin\GeneticAlgorithm\Contracts\EvolutionInterface;

/**
 * Class Evolution
 * @package Darvin\GeneticAlgorithm\Evolution
 */
class Evolution implements EvolutionInterface
{

    /* @var $crossover CrossoverInterface */
    public $crossover;

    /* @var $mutation MutationInterface */
    public $mutation;

    /* @var $pool PoolSelectionInterface */
    public $pool;

    /* @var $settings SettingsInterface */
    public $settings;

    /* @var $individual PoolSelectionInterface */
    public $individual;

    /**
     * Evolution constructor.
     * @param CrossoverInterface $crossover
     * @param MutationInterface $mutation
     * @param PoolSelectionInterface $pool
     */
    public function __construct(CrossoverInterface $crossover, MutationInterface $mutation, PoolSelectionInterface $pool)
    {
        $this->crossover = $crossover;
        $this->mutation = $mutation;
        $this->pool = $pool;
    }

    /**
     * @param PopulationInterface $pop
     * @return Population
     */
    public function evolvePopulation(PopulationInterface $pop)
    {
        $this->settings = $pop->getSettings();
        $this->individual = $pop->getOriginIndividual();

        // Новая популяция, для проведения скрещивания и мутаций
        $newPopulation = new Population($this->individual, $this->settings, $pop->size(), false);


        $elitismOffset = 0;
        // Нужен ли элитизм, сохранять ли самого приспособленного?
        if ($this->settings->elitism) {
            $newPopulation->saveIndividual(0, $pop->getFittest());
            $elitismOffset=1;
        }

        /* Скрещивание */

        for ($i = $elitismOffset; $i < $pop->size(); $i++) {
            $indiv1 = $this->pool->poolSelect($pop);
            $indiv2 = $this->pool->poolSelect($pop);

            $newIndiv = $this->crossover->crossoverIndividuals($indiv1, $indiv2);

            $newPopulation->saveIndividual($i, $newIndiv);
        }

        // Мутации

        for ($i=$elitismOffset; $i < $newPopulation->size(); $i++) {
            $mutated = $this->mutation->mutate($newPopulation->getIndividual($i));
            $newPopulation->saveIndividual($i, $mutated);
        }

        return $newPopulation;
    }
}