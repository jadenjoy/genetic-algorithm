<?php

namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface IndividualInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface IndividualInterface
{
    /**
     * @param $genomeSize
     * @return mixed
     */
    public function generateIndividual($genomeSize);

    /**
     * @param FitnessInterface $delegate
     * @return mixed
     */
    public function setFitnessDelegate(FitnessInterface $delegate);

    /**
     * @param $index
     * @return mixed
     */
    public function getGene($index);

    /**
     * @param $index
     * @param $value
     * @return mixed
     */
    public function setGene($index, $value);

    /**
     * @return mixed
     */
    public function genomeSize();

    /**
     * @return mixed
     */
    public function randomGene();

    /**
     * @return mixed
     */
    public function getGenome();

    /**
     * @param $genome
     * @return mixed
     */
    public function setGenome($genome);
}
