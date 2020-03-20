<?php

namespace Darvin\GeneticAlgorithm\Crossover;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;

class DefaultCrossover extends AbstractCrossover {

    public function crossoverIndividuals(IndividualInterface $individual1, IndividualInterface $individual2)
    {
        $newSol = clone $individual1;  //create a offspring
        // Loop through genes
        for ($i=0; $i < $individual1->genomeSize(); $i++) {
            // Crossover at which point 0..1 , .50 50% of time
            if (  ((float)rand() / (float)getrandmax()) <= $this->settings->uniformRate)
            {
                $newSol->setGene($i, $individual1->getGene($i) );
            } else {
                $newSol->setGene($i, $individual2->getGene($i));
            }
        }

        return $newSol;

    }


}