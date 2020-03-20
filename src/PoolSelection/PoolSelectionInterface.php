<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:30
 */
namespace Axiom\GeneticAlgorithm\PoolSelection;
use Axiom\GeneticAlgorithm\Population\PopulationInterface;

interface PoolSelectionInterface {
    public function poolSelection(PopulationInterface $pop);
}
