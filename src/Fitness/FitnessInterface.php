<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:05
 */
namespace Axiom\GeneticAlgorithm\Fitness;
use Axiom\GeneticAlgorithm\Settings\SettingsInterface;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;

interface FitnessInterface
{
    public function getFitness(IndividualInterface $individual);
    public function getMaxFitness();
    public function setSettings(SettingsInterface $settings);
}