<?php

namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface MutationInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface MutationInterface
{
    /**
     * @param IndividualInterface $individual
     * @return mixed
     */
    public function mutate(IndividualInterface $individual);
}
