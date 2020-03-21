<?php

namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface FitnessInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface FitnessInterface
{
    /**
     * @param IndividualInterface $individual
     * @return mixed
     */
    public function getFitness(IndividualInterface $individual);

    /**
     * @return mixed
     */
    public function getMaxFitness();
}