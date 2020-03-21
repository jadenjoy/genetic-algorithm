<?php

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\CrossoverInterface;
use Darvin\GeneticAlgorithm\Contracts\IndividualInterface;

/**
 * Class Crossover
 * @package Darvin\GeneticAlgorithm
 */
class Crossover extends AlgorithmPart implements CrossoverInterface
{

    /* @var $settings IndividualInterface */
    public $individual;


    /**
     * @param IndividualInterface $individual
     * @return IndividualInterface
     */
    public function setOriginalIndividual(IndividualInterface $individual)
    {
        $this->individual = $individual;
        return $this->individual;
    }


    /**
     * @param IndividualInterface $individual1
     * @param IndividualInterface $individual2
     * @return IndividualInterface
     */
    public function crossoverIndividuals(IndividualInterface $individual1, IndividualInterface $individual2)
    {
        $newSol = clone $individual1;  //create a offspring
        // Loop through genes
        for ($i=0; $i < $individual1->genomeSize(); $i++) {
            // Crossover at which point 0..1 , .50 50% of time
            if (((float)rand() / (float)getrandmax()) <= $this->algorithm->getSettings()->uniformRate) {
                $newSol->setGene($i, $individual1->getGene($i));
            } else {
                $newSol->setGene($i, $individual2->getGene($i));
            }
        }

        return $newSol;
    }

}