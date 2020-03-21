<?php
namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\PopulationInterface;
use Darvin\GeneticAlgorithm\Contracts\PoolSelectionInterface;

/**
 * Class PoolSelection
 * @package Darvin\GeneticAlgorithm
 */
class PoolSelection extends AlgorithmPart implements PoolSelectionInterface
{

    /**
     * @param PopulationInterface $pop
     * @return Contracts\IndividualInterface|GAIndividualInterface|mixed
     */
    public function poolSelect(PopulationInterface $pop)
    {
        $settings =  $this->algorithm->getSettings();
        $individual = $this->algorithm->getIndividual();
        $pool = new Population($individual, $settings, $settings->poolSize, false);


        for ($i=0; $i < $settings->poolSize; $i++) {
            $randomId = rand(0, $pop->size()-1); //Get a random individual from anywhere in the population
            $pool->saveIndividual($i, $pop->getIndividual($randomId));

        }
        return $pool->getFittest();
    }
}
