<?php
namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\IndividualInterface;
use Darvin\GeneticAlgorithm\Contracts\MutationInterface;

/**
 * Class Mutation
 * @package Darvin\GeneticAlgorithm
 */
class Mutation extends AlgorithmPart implements MutationInterface
{

    /**
     * Basic mutation function
     * @param IndividualInterface $individual
     * @return IndividualInterface
     */
    public function mutate(IndividualInterface $individual)
    {

        for ($i=0; $i < $individual->genomeSize(); $i++) {
            if (((float)rand() / (float)getrandmax()) <= $this->algorithm->getSettings()->mutationRate) {
                $gene = $individual->randomGene();   // Create random gene
                $individual->setGene($i, $gene); //substitute the gene into the individual
            }
        }
        return $individual;
    }
}
