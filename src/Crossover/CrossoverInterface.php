<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:20
 */
namespace Darvin\GeneticAlgorithm\Crossover;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;

interface CrossoverInterface
{
    public function crossoverIndividuals(IndividualInterface $individual1, IndividualInterface $individual2);
    public function setSettings(SettingsInterface $settings);
    public function setOriginalIndividual(IndividualInterface $individual);
}