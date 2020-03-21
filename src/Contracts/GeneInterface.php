<?php

namespace Darvin\GeneticAlgorithm\Contracts;

/**
 * Interface GeneInterface
 * @package Darvin\GeneticAlgorithm\Contracts
 */
interface GeneInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function value($value);

    /**
     * @param $param
     * @return mixed
     */
    public function param($param);
}