<?php

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\IndividualInterface;
use Darvin\GeneticAlgorithm\Contracts\FitnessInterface;

/**
 * Class Fitness
 * @package Darvin\GeneticAlgorithm
 */
class Fitness implements FitnessInterface
{

    /**
     * @var mixed $fitnessFunction Замыкание для расчета фитнеса
     */
    public $fitnessFunction;


    /**
     * Calculate individuals fitness by comparing it to our candidate solution
     * low fitness values are better,0=goal fitness is really a cost function in this instance
     * @param IndividualInterface $individual
     * @return mixed
     */
    public function getFitness(IndividualInterface $individual)
    {
        return ($this->fitnessFunction)($individual);
    }

    /**
     * Get optimum fitness
     * @return int
     */
    public function getMaxFitness()
    {
        return 0;
    }

    /**
     * Set Fintess Funstion Closure
     * @param $closure
     */
    public function setMainPart($closure)
    {
        $this->fitnessFunction = $closure;
    }
}
