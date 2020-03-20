<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:44
 */
namespace Darvin\GeneticAlgorithm\Settings;

abstract class AbstractSettings implements SettingsInterface
{
    public $uniformRate;
    public $mutationRate;
    public $poolSize;
    public $initial_population_size;
    public $max_generation_stagnant;
    public $elitism;

    // Настройки особей
    public $genomeSize;
}