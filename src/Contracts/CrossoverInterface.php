<?php

namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface CrossoverInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface CrossoverInterface
{
    /**
     * @param IndividualInterface $individual1
     * @param IndividualInterface $individual2
     * @return mixed
     */
    public function crossoverIndividuals(IndividualInterface $individual1, IndividualInterface $individual2);


    /**
     * @param IndividualInterface $individual
     * @return mixed
     */
    public function setOriginalIndividual(IndividualInterface $individual);
}