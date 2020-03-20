<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 03:27
 */
namespace Axiom\GeneticAlgorithm\Population;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;

interface PopulationInterface {
    public function saveIndividual($index, IndividualInterface $indiv);
    public function getFittest();
    public function getSettings();
    public function getOriginIndividual();
    public function size();
    public function getIndividual($index);
}