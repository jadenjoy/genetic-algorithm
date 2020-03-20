<?php

namespace Axiom\GeneticAlgorithm\Crossover;
use Axiom\GeneticAlgorithm\Settings\SettingsInterface;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;


abstract class AbstractCrossover implements CrossoverInterface {
    /* @var $settings SettingsInterface */
    public $settings;

    /* @var $settings IndividualInterface */
    public $individual;

    /**
     * @param SettingsInterface $settings
     */
    public function setSettings(SettingsInterface $settings) {
        $this->settings = $settings;
    }

    /**
     * @param IndividualInterface $individual
     */
    public function setOriginalIndividual(IndividualInterface $individual) {
        $this->individual = $individual;
    }

}