<?php
/**
 * Darvin Genetic Algorithm - A PHP Library inspired by Charles Darwin's theory
 *
 * @package Darvin_Genetic_Algorithm
 * @author  Tundaikin Konstantin <edeminteractive@gmail.com>
 */

namespace Darvin\GeneticAlgorithm;


use Darvin\GeneticAlgorithm\AlgorithmDelegate\AlgorithmDelegate;
use Darvin\GeneticAlgorithm\AlgorithmDelegate\AlgorithmDelegateInterface;
use Darvin\GeneticAlgorithm\Crossover\CrossoverInterface;
use Darvin\GeneticAlgorithm\Evolution\EvolutionInterface;
use Darvin\GeneticAlgorithm\Fitness\FitnessInterface;
use Darvin\GeneticAlgorithm\Individual\IndividualInterface;
use Darvin\GeneticAlgorithm\Mutation\MutationInterface;
use Darvin\GeneticAlgorithm\PoolSelection\PoolSelectionInterface;
use Darvin\GeneticAlgorithm\Population\PopulationInterface;
use Darvin\GeneticAlgorithm\Settings\SettingsInterface;

class Algorithm
{

    /*
    |--------------------------------------------------------------------------
    | Algorithm Statuses
    |--------------------------------------------------------------------------
    |
    | Uses with AlgorithmDelegate, as example: use ALGORITHM_STATUS_CONTINUE to
    | contine algorithm even if max generation stagnant reached.
    |
    */

    /**
     * Breaks algorithm
     */
    const ALGORITHM_STATUS_BREAK = 0;
    /**
     * Contine algorithm
     */
    const ALGORITHM_STATUS_CONTINUE = 1;
    /**
     * No status
     */
    const ALGORITHM_STATUS_NO_STATUS = 3;
    /**
     * Stops algorithm
     */
    const ALGORITHM_STATUS_STOP = 4;

    /*
    |--------------------------------------------------------------------------
    | Evolution
    |--------------------------------------------------------------------------
    |
    | This algorithm reflects the process of natural selection where the fittest
    | individuals are selected for reproduction in order to produce offspring of
    | the next generation.
    |  Five phases are considered in a genetic algorithm.
    |   - Initial population
    |   - Fitness function
    |   - Selection
    |   - Crossover
    |   - Mutation
    |
    */

    /* @var $population PopulationInterface */
    public $population;
    /* @var $fitness FitnessInterface */
    public $fitness;
    /* @var $individual IndividualInterface */
    public $individual;
    /* @var $crossover CrossoverInterface */
    public $crossover;
    /* @var $mutation MutationInterface */
    public $mutation;
    /* @var $pool PoolSelectionInterface */
    public $pool;
    /* @var $evolution EvolutionInterface */
    public $evolution;
    /* @var $delegate AlgorithmDelegateInterface */
    public $delegate;

    // Делегирование событий
    /**
     * Сколько прошло поколений
     *
     * @var int
     */
    public $generationCount = 0;


    /*
    |--------------------------------------------------------------------------
    | Algorithm parameters
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Maximum
     * @var int
     */
    public $generation_stagnant = 0;
    /**
     * @var int
     */
    public $most_fit = 0;
    /**
     * @var int
     */
    public $most_fit_last = 40000;

    /* @var $settings SettingsInterface */
    private $settings;

    /**
     * Algorithm constructor.
     * @param SettingsInterface      $settings
     * @param IndividualInterface    $individual
     * @param FitnessInterface $fitness
     * @param CrossoverInterface $crossover
     * @param MutationInterface $mutation
     * @param PoolSelectionInterface $pool
     */

    function __construct(SettingsInterface $settings, IndividualInterface $individual,
                         FitnessInterface $fitness, CrossoverInterface $crossover,
                         MutationInterface $mutation, PoolSelectionInterface $pool)
    {
        /*
         * Set Algorithm Settings
         *
         */
        $this->settings = $settings;

        /*
         * Initialize fitness algorithm
         */
        $this->initializeFitness($fitness);

        /*
         * Initialize Individual
         */
        $this->initializeIndividual($individual);

        /*
         * Initialize Crossover
         */
        $this->initializeCrossover($crossover);

        /*
         * Initialize Mutation
         */
        $this->initializeMutation($mutation);

        /*
         * Initialize PoolSeletion
         */
        $this->initializePoolSelection($pool);


        /*
         * Init Delegates
         */
        $this->setupAlgorithmDelegate();
    }

    /**
     * @param FitnessInterface $fitness
     */
    public function initializeFitness(FitnessInterface $fitness)
    {
        $fitness->setSettings($this->settings);
        $this->setFitness($fitness);
    }

    /**
     * @param IndividualInterface $individual
     */
    public function initializeIndividual(IndividualInterface $individual)
    {
        $individual->setFitnessDelegate($this->fitness);
        $this->setIndividual($individual);
    }

    /**
     * @param CrossoverInterface $crossover
     */
    public function initializeCrossover(CrossoverInterface $crossover)
    {
        $crossover->setOriginalIndividual($this->individual);
        $crossover->setSettings($this->settings);
        $this->setCrossover($crossover);
    }

    /**
     * @param MutationInterface $mutation
     */
    public function initializeMutation(MutationInterface $mutation)
    {
        $mutation->setOriginalIndividual($this->individual);
        $mutation->setSettings($this->settings);
        $this->setMutation($mutation);
    }

    /**
     * @param PoolSelectionInterface $poolSelection
     */
    public function initializePoolSelection(PoolSelectionInterface $poolSelection)
    {
        $this->setPool($poolSelection);
    }

    /**
     *
     */
    public function setupAlgorithmDelegate()
    {
        $this->delegate = new AlgorithmDelegate();
    }

    /**
     * @return SettingsInterface
     */
    public function getSettings(): SettingsInterface
    {
        return $this->settings;
    }

    /**
     * @param SettingsInterface $settings
     */

    public function setSettings(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return FitnessInterface
     */
    public function getFitness(): FitnessInterface
    {
        return $this->fitness;
    }

    /**
     * @param FitnessInterface $fitness
     */
    public function setFitness(FitnessInterface $fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * @return IndividualInterface
     */
    public function getIndividual(): IndividualInterface
    {
        return $this->individual;
    }

    /**
     * @param IndividualInterface $individual
     */
    public function setIndividual(IndividualInterface $individual)
    {
        $this->individual = $individual;
    }

    /**
     * @return CrossOverInterface
     */
    public function getCrossover(): CrossoverInterface
    {
        return $this->crossover;
    }

    /**
     * @param CrossoverInterface $crossover
     */
    public function setCrossover(CrossoverInterface $crossover)
    {
        $this->crossover = $crossover;
    }

    /**
     * @return mixed
     */
    public function getMutation(): MutationInterface
    {
        return $this->mutation;
    }

    /**
     * @param mixed $mutation
     */
    public function setMutation(MutationInterface $mutation)
    {
        $this->mutation = $mutation;
    }

    /**
     * @return mixed
     */
    public function getPool(): PoolSelectionInterface
    {
        return $this->pool;
    }

    /**
     * @param mixed $pool
     */
    public function setPool(PoolSelectionInterface $pool)
    {
        $this->pool = $pool;
    }

    /**
     * @return mixed
     */
    public function getDelegate(): AlgorithmDelegateInterface
    {
        return $this->delegate;
    }

    /**
     * @return PopulationInterface
     */
    public function getPopulation(): PopulationInterface
    {
        return $this->population;
    }

    /**
     * @param PopulationInterface $population
     */
    public function setPopulation(PopulationInterface $population)
    {
        $this->population = $population;
    }

    /**
     * @return EvolutionInterface
     */
    public function getEvolution(): EvolutionInterface
    {
        return $this->evolution;
    }

    /**
     * @param EvolutionInterface $evolution
     */
    public function setEvolution(EvolutionInterface $evolution)
    {
        $this->evolution = $evolution;
    }

    /**
     *
     */
    public function start()
    {
        $lifecycle = new Lifecycle($this);
        $lifecycle->startLifecycle();
    }


    /**
     *
     */
    public function increaseGenerationCount()
    {
        $this->generationCount++;
    }

    /**
     * @return int
     */
    public function getGenerationCount(): int
    {
        return $this->generationCount;
    }

    /**
     * @param int $generationCount
     */
    public function setGenerationCount(int $generationCount)
    {
        $this->generationCount = $generationCount;
    }

    /**
     * @return int
     */
    public function getGenerationStagnant(): int
    {
        return $this->generation_stagnant;
    }

    /**
     * @param int $generation_stagnant
     */
    public function setGenerationStagnant(int $generation_stagnant)
    {
        $this->generation_stagnant = $generation_stagnant;
    }

    /**
     * @return int
     */
    public function getMostFit(): int
    {
        return $this->most_fit;
    }

    /**
     * @param int $most_fit
     */
    public function setMostFit(int $most_fit)
    {
        $this->most_fit = $most_fit;
    }

    /**
     * @return int
     */
    public function getMostFitLast(): int
    {
        return $this->most_fit_last;
    }

    /**
     * @param int $most_fit_last
     */
    public function setMostFitLast(int $most_fit_last)
    {
        $this->most_fit_last = $most_fit_last;
    }


    /**
     *
     */
    public function resetGenerationStagnant()
    {
        $this->generation_stagnant = 0;
    }

    /**
     *
     */
    public function increaseGenerationStagnant()
    {
        $this->generation_stagnant++;
    }
}
