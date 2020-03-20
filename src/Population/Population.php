<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 03:28
 */
namespace Darvin\GeneticAlgorithm\Population;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;

class Population implements PopulationInterface {

    //class properties
    /** @var GAIndividualInterface[] */
    public $colony=array();
    /* @var $individual IndividualInterface */
    public $individual;
    /* @var $settings SettingsInterface */
    public $settings;


    function __construct(IndividualInterface $individual, SettingsInterface $settings, $populationSize, $initialise = false)
    {
        $this->individual = $individual;
        $this->settings = $settings;
        if (!isset($populationSize) || $populationSize==0) {
            die("Размер популяции должен быть больше > 0");
        }

        for ($i=0;$i<$populationSize; $i++) {
            $this->colony[$i] = clone $this->individual;  //instantiate a new object
        }
        // Initialise population
        if ($initialise)
        {
            // Loop and create individuals
            for ($i = 0; $i < count($this->colony); $i++) {
                /* @var $new_individual IndividualInterface */
                $new_individual = clone $this->individual;

                $new_individual->generateIndividual($settings->genomeSize);

                $this->saveIndividual($i, $new_individual);
            }
        }
    }


    // Сохранение особи
    public function saveIndividual($index, IndividualInterface $indiv) {
        $this->colony[$index] = $indiv;
    }


    // Выбор самого успешного
    public function getFittest() {
        /* @var $fittest IndividualInterface */
        $fittest = $this->colony[0];  //create a starting point for fitness person0


        // Loop through individuals to find fittest
        for ($i = 0; $i < $this->size(); $i++) {
            if ($fittest->getFitness() >= $this->colony[$i]->getFitness() ) {
                $fittest = $this->colony[$i];
            }

        }
        return $fittest;
    }


    /* Публичные методы */
    // Получить особь
    public function getIndividual($index) {
        return  $this->colony[$index];
    }
    // Размер популяции
    public function size() {
        return count($this->colony);
    }

    public function getOriginIndividual() {
        return $this->individual;
    }

    public function getSettings() {
        return $this->settings;
    }




}