<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:30
 */
namespace Darvin\GeneticAlgorithm\PoolSelection;
use Darvin\GeneticAlgorithm\Population\PopulationInterface;

interface PoolSelectionInterface {
    public function poolSelection(PopulationInterface $pop);
}
