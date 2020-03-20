<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:26
 */
namespace Darvin\GeneticAlgorithm\Mutation;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;

class DefaultMutation extends Mutation {

    public function mutate(IndividualInterface $individual)
    {
        for ($i=0; $i < $individual->genomeSize(); $i++) {
            if (  ((float)rand() / (float)getrandmax()) <= $this->settings->mutationRate) {
                $gene = $this->individual->randomGene();   // Create random gene
                $individual->setGene($i, $gene); //substitute the gene into the individual
            }
        }
        return $individual;
    }


}