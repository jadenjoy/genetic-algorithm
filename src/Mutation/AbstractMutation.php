<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:22
 */

namespace Axiom\GeneticAlgorithm\Mutation;
use Axiom\GeneticAlgorithm\Settings\SettingsInterface;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;

abstract class Mutation implements MutationInterface {
    /* @var $settings SettingsClass */
    public $settings;
    /* @var $individual IndividualInterface */
    public $individual;

    public function setSettings(SettingsInterface $settings) {
        $this->settings = $settings;
    }

    public function setOriginalIndividual(IndividualInterface $individual) {
        $this->individual = $individual;
    }

}