<?php
namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface PoolSelectionInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface PoolSelectionInterface
{
    /**
     * @param PopulationInterface $pop
     * @return mixed
     */
    public function poolSelect(PopulationInterface $pop);
}
