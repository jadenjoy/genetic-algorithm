<?php

namespace Darvin\GeneticAlgorithm;

/**
 * Class AlgorithmPart
 * @package Darvin\GeneticAlgorithm
 */
class AlgorithmPart
{
    /* @var $algorithm Algorithm */
    public $algorithm;


    /**
     * AlgorithmPart constructor.
     * @param Algorithm $algorithm
     */
    public function __construct(Algorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }
}
