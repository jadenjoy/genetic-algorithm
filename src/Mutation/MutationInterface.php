<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:35
 */
namespace Axiom\GeneticAlgorithm\Mutation;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;
use Axiom\GeneticAlgorithm\Settings\SettingsInterface;

interface MutationInterface {
    public function mutate(IndividualInterface $individual);
    public function setSettings(SettingsInterface $settings);
    public function setOriginalIndividual(IndividualInterface $individual);
}