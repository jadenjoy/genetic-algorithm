<?php
/**
 * Darvin Genetic Algorithm - A PHP Library inspired by Charles Darwin's theory
 *
 * @package Darvin_Genetic_Algorithm
 * @author  Tundaikin Konstantin <edeminteractive@gmail.com>
 */

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\SettingsInterface;
use Darvin\GeneticAlgorithm\Contracts\IndividualInterface;
use Darvin\GeneticAlgorithm\Contracts\MutationInterface;
use Darvin\GeneticAlgorithm\Contracts\FitnessInterface;
use Darvin\GeneticAlgorithm\Contracts\PopulationInterface;
use Darvin\GeneticAlgorithm\Contracts\CrossoverInterface;
use Darvin\GeneticAlgorithm\Contracts\PoolSelectionInterface;
use Darvin\GeneticAlgorithm\Contracts\EvolutionInterface;

/**
 * Class Algorithm
 * @package Darvin\GeneticAlgorithm
 */
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
    /* @var $delegate AlgorithmEvents */
    public $events;

    /**
     * @var PartBuilder
     */
    public $builder;

    // Делегирование событий
    /* @var $settings SettingsInterface */
    private $settings;

    /**
     * @var int
     */
    private $status = self::ALGORITHM_STATUS_NO_STATUS;

    /**
     * Algorithm constructor.
     * @param SettingsInterface      $settings
     */

    public function __construct(SettingsInterface $settings)
    {
        /*
         * Set Algorithm Settings
         *
         */
        $this->settings = $settings;

        /*
         * Initialize fitness algorithm
         */
        $this->fitness = new Fitness();

        /*
         * Initialize Individual
         */
        $this->individual = new Individual($this->fitness);

        /*
         * Initialize Crossover
         */
        $this->crossover = new Crossover($this);

        /*
         * Initialize Mutation
         */
        $this->mutation = new Mutation($this);

        /*
         * Initialize PoolSeletion
         */
        $this->pool = new PoolSelection($this);

        /*
         * Init Delegates
         */
        $this->setupAlgorithmDelegate();

        /*
         * Init Part Builder
         */
        $this->builder = new PartBuilder($this);
    }


    /**
     *
     */
    public function setupAlgorithmDelegate()
    {
        $this->events = new AlgorithmEvents();
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
    public function getEvents(): AlgorithmEvents
    {
        return $this->events;
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
     * @param $part
     * @param $closure
     */
    public function setPart($part, $closure) {
        $this->builder->setPart($part, $closure);
    }

    /**
     * @return int
     */
    public function algorithmStatus() {
        return $this->status;
    }
}
