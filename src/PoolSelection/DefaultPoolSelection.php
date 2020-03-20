<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:32
 */
namespace Axiom\GeneticAlgorithm\PoolSelection;
use Axiom\GeneticAlgorithm\Population\PopulationInterface;
use Axiom\GeneticAlgorithm\Population\Population;

class DefaultPoolSelection implements PoolSelectionInterface {

    public function poolSelection(PopulationInterface $pop)
    {
        /* @var $settings GASettingsClass */
        $settings =  $pop->getSettings();
        $individual = $pop->getOriginIndividual();
        $pool = new Population($individual, $settings, $settings->poolSize, false);


        for ($i=0; $i < $settings->poolSize; $i++) {
            $randomId = rand(0, $pop->size()-1 ); //Get a random individual from anywhere in the population
            $pool->saveIndividual($i, $pop->getIndividual($randomId));

        }

        return $pool->getFittest();
    }
}