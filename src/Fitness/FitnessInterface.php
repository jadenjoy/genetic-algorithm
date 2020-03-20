<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:05
 */
namespace Darvin\GeneticAlgorithm\Fitness;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;

interface FitnessInterface
{
    public function getFitness(IndividualInterface $individual);
    public function getMaxFitness();
    public function setSettings(SettingsInterface $settings);
}