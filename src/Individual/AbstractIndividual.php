<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:56
 */
namespace Axiom\GeneticAlgorithm\Individual;
use Axiom\GeneticAlgorithm\Fitness\FitnessInterface;

abstract class AbstractIndividual implements IndividualInterface {

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

    // Установка делегата для подсчета фитнеса
    public function setFitnessDelegate(FitnessInterface $delegate)
    {
        $this->fitnessDelegate = $delegate;
    }


    public function getGene($index) {
        return $this->genes[$index];
    }

    public function setGene($index,$value) {
        $this->genes[$index] = $value;
        $this->fitness = 0;
    }

    /* Public methods */
    public function genomeSize() {
        return count($this->genes);
    }

    public function getGenome() {
        return $this->genes;
    }

    public function setGenome($genome) {
        $this->genes = $genome;
    }

    public function getFitness() {
        $this->fitness = $this->fitnessDelegate->getFitness($this);
        return $this->fitness;

    }


}