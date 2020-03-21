<?php
namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface PopulationInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface PopulationInterface
{
    /**
     * @param $index
     * @param IndividualInterface $indiv
     * @return mixed
     */
    public function saveIndividual($index, IndividualInterface $indiv);

    /**
     * @return mixed
     */
    public function getFittest();

    /**
     * @return mixed
     */
    public function getSettings();

    /**
     * @return mixed
     */
    public function getOriginIndividual();

    /**
     * @return mixed
     */
    public function size();

    /**
     * @param $index
     * @return mixed
     */
    public function getIndividual($index);
}