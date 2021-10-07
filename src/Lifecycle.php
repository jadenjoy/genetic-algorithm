<?php
/**
 * Darvin Genetic Algorithm - A PHP Library inspired by Charles Darwin's theory of natural evolution
 *
 * @package  Darvin Genetic Algorithm
 * @author   Tundaikin Konstantin <edeminteractive@gmail.com>
 */

namespace Darvin\GeneticAlgorithm;

/**
 * Class Lifecycle
 * @package Darvin\GeneticAlgorithm
 */
class Lifecycle extends AlgorithmPart
{
    /*
    |--------------------------------------------------------------------------
    | Lifecycle parameters
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Сколько прошло поколений
     *
     * @var int
     */
    public $generationCount = 0;
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
    public $most_fit_last = INF;

    /*
    |--------------------------------------------------------------------------
    | Lifecycle
    |--------------------------------------------------------------------------
    | The process begins with a set of individuals which is called a Population.
    | Each individual is a solution to the problem you want to solve.
    |
    */


    public function startLifecycle()
    {
        /*
         * Call delegate
         */
        $events = $this->algorithm->getEvents();
        $events->trigger("algorithmStart", $this->algorithm);

        $alg = $this->algorithm;
        $settings = $alg->getSettings();
        /*
         * Check status before start
         */
        $status = $this->algorithm->algorithmStatus();

        /*
         * Startup status?
         */
        if ($status == Algorithm::ALGORITHM_STATUS_BREAK || $status == Algorithm::ALGORITHM_STATUS_STOP) {
            return false;
        }


        // TODO: Looks too complicated use Algorithm Facade
        $alg->setPopulation(new Population($alg->getIndividual(), $settings, $settings->initial_population_size, true));

        $this->algorithm->setEvolution(new Evolution($alg->getCrossover(), $alg->getMutation(), $alg->getPool()));

        while ($alg->getPopulation()->getFittest()->getFitness() > $alg->getFitness()->getMaxFitness()) {
            $status = $this->algorithm->algorithmStatus();
            if ($status == Algorithm::ALGORITHM_STATUS_STOP) {
                return false;
            }
            if ($status == Algorithm::ALGORITHM_STATUS_BREAK) {
                break;
            }

            // Первое поколение
            $this->increaseGenerationCount();
            // Сообщеаем делегату
            $events->trigger("newGeneration", $this->generationCount);
            // Выбираем самого приспособленного
            $this->setMostFit($alg->getPopulation()->getFittest()->getFitness());
            //Создаем новую популяцию
            $alg->setPopulation($alg->getEvolution()->evolvePopulation($alg->getPopulation()));

            if ($this->most_fit < $this->most_fit_last) {
                $events->trigger("newSolutionFound", $alg);
                $this->most_fit_last = $this->most_fit;
                $this->resetGenerationStagnant();

            } else {
                $this->increaseGenerationStagnant();
            }

            if ($this->generation_stagnant > $alg->getSettings()->max_generation_stagnant) {
                $events->trigger("maxGenerationStagnantReached", $alg);
                $status = $alg->algorithmStatus();
                if ($status != Algorithm::ALGORITHM_STATUS_CONTINUE) {
                    break;
                }
            }
        }
        $events->trigger("finalSolutionFound", $alg);
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