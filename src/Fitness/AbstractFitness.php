<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:08
 */
namespace Darvin\GeneticAlgorithm\Fitness;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;

abstract class AbstractFitness implements FitnessInterface
{

    public $settings;

    public function setSettings(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }
}