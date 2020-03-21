<?php

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\FitnessInterface;
use Darvin\GeneticAlgorithm\Contracts\IndividualInterface;

/**
 * Class Individual
 * @package Darvin\GeneticAlgorithm
 */
class Individual implements IndividualInterface
{
    /**
     * Individual constructor.
     * @param FitnessInterface $fitness
     */
    public function __construct(FitnessInterface $fitness)
    {
        $this->fitnessDelegate = $fitness;
    }

    /* @var $fitnessDelegate FitnessInterface */
    public $fitnessDelegate;
    // Гены

    /**
     * @var array
     *
     */
    public $genes = [];
    /**
     * Сохраняем вычисленное значение
     * @var int
     */
    public $fitness = null;

    /**
     * Замыкание с генерацией гена
     * @var null
     */
    public $gene = null;


    // Установка делегата для подсчета фитнеса
    /**
     * @param FitnessInterface $delegate
     */
    public function setFitnessDelegate(FitnessInterface $delegate)
    {
        $this->fitnessDelegate = $delegate;
    }

    /**
     * @param $index
     * @return mixed
     */
    public function getGene($index)
    {
        return $this->genes[$index];
    }


    /**
     * @param $index
     * @param $value
     */
    public function setGene($index, $value)
    {
        $this->genes[$index] = $value;
        $this->fitness = 0;
    }

    /* Public methods */
    /**
     * @return int
     */
    public function genomeSize()
    {
        return count($this->genes);
    }

    /**
     * @return array
     */
    public function getGenome()
    {
        return $this->genes;
    }

    /**
     * @param $genome
     */
    public function setGenome($genome)
    {
        $this->genes = $genome;
    }

    /**
     * @return int|mixed
     */
    public function getFitness()
    {
        // TODO: убрать повторение названией функций
        $this->fitness = $this->fitnessDelegate->getFitness($this);
        return $this->fitness;
    }

    /**
     * @param $genomeSize
     */
    public function generateIndividual($genomeSize)
    {
        //now lets randomly load the genes (array of ascii characters) to the size of the array
        for ($i=0; $i < $genomeSize; $i++) {
            $this->genes[$i] = $this->randomGene();
        }
    }

    /**
     * @return Gene
     */
    public function randomGene()
    {
        $newGene = new Gene();
        ($this->gene)($newGene);
        return $newGene;
    }


    /**
     * @param $closure
     */
    public function setGenePart($closure)
    {
        $this->gene = $closure;
    }
}
