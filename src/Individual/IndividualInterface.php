<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:07
 */

namespace Axiom\GeneticAlgorithm\Individual;
use Axiom\GeneticAlgorithm\Fitness\FitnessInterface;

interface IndividualInterface {
    public function generateIndividual($genomeSize);
    public function setFitnessDelegate(FitnessInterface $delegate);
    public function getGene($index);
    public function setGene($index,$value);
    public function genomeSize();
    public function randomGene();
    public function getGenome();
    public function setGenome($genome);
}