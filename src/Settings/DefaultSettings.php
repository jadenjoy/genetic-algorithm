<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:45
 */
namespace Axiom\GeneticAlgorithm\Settings;

class DefaultSettings extends AbstractSettings  {
    /**
     *
    $this->uniformRate = 0.5;
    $this->mutationRate = 0.05; // 0.05
    $this->poolSize = 5;
    $this->initial_population_size = 10;
    $this->max_generation_stagnant = 400;
    $this->elitism = true;

    // Особей
    $this->genomeSize = 10;
     */


    public function __construct()
    {
        // Базовые значения
        $this->uniformRate = 0.5;
        $this->mutationRate = 0.02; // 0.01 - 0.02
        $this->poolSize = 5;
        $this->initial_population_size = 10;
        $this->max_generation_stagnant = 400;
        $this->elitism = true;

        // Особей
        $this->genomeSize = 10;

    }

}