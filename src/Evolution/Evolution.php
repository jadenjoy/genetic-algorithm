<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 03:51
 */
namespace Darvin\GeneticAlgorithm\Evolution;

use Darvin\GeneticAlgorithm\Crossover\CrossoverInterface;
use Darvin\GeneticAlgorithm\Mutation\MutationInterface;
use Darvin\GeneticAlgorithm\PoolSelection\PoolSelectionInterface;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;
use Darvin\GeneticAlgorithm\Population\PopulationInterface;
use Darvin\GeneticAlgorithm\Population\Population;

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
            $indiv1 = $this->pool->poolSelection($pop);
            $indiv2 = $this->pool->poolSelection($pop);

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