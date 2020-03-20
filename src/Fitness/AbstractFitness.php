<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:08
 */
namespace Axiom\GeneticAlgorithm\Fitness;
use Axiom\GeneticAlgorithm\Settings\SettingsInterface;

abstract class AbstractFitness implements FitnessInterface {

    public $settings;

    function setSettings(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }
}