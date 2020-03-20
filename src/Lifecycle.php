<?php
/**
 * Darvin Genetic Algorithm - A PHP Library inspired by Charles Darwin's theory of natural evolution
 *
 * @package  Darvin Genetic Algorithm
 * @author   Tundaikin Konstantin <edeminteractive@gmail.com>
 */

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Evolution\Evolution;
use Darvin\GeneticAlgorithm\Population\Population;

class Lifecycle
{

    /* @var $algorithm Algorithm */
    private $algorithm;


    public function __construct(Algorithm $algorithm)
    {
        $this->setAlgorithm($algorithm);
    }


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
        $delegate = $this->algorithm->getDelegate();
        $delegate->algorithmStart($this->algorithm);

        $alg = $this->algorithm;
        $settings = $alg->getSettings();
        /*
         * Check status before start
         */
        $status = $delegate->algorithmStatus();

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

            $status = $delegate->algorithmStatus();
            if ($status == Algorithm::ALGORITHM_STATUS_STOP) {
                return false;
            }
            if ($status == Algorithm::ALGORITHM_STATUS_BREAK) {
                break;
            }

            // Первое поколение
            $alg->increaseGenerationCount();
            // Сообщеаем делегату
            $delegate->newGeneration($alg->getGenerationCount());
            // Выбираем самого приспособленного
            $alg->setMostFit($alg->getPopulation()->getFittest()->getFitness());
            //Создаем новую популяцию
            $alg->setPopulation($alg->getEvolution()->evolvePopulation($alg->getPopulation()));

            if ($alg->getMostFit() < $alg->getMostFitLast()) {
                $delegate->newSolutionFound($alg);
                $alg->setMostFitLast($alg->getMostFit());
                $alg->resetGenerationStagnant();

            } else {
                $alg->increaseGenerationStagnant();
            }

            if ($alg->getGenerationStagnant() > $alg->getSettings()->max_generation_stagnant) {
                $delegate->maxGenerationStagnantReached($alg);
                $status = $delegate->algorithmStatus();
                if ($status != Algorithm::ALGORITHM_STATUS_CONTINUE) {
                    break;
                }
            }
        }

        $delegate->finalSolutionFound($alg);
    }

    /**
     * @return Algorithm
     */
    public function getAlgorithm(): Algorithm
    {
        return $this->algorithm;
    }

    /**
     * @param Algorithm $algorithm
     */
    public function setAlgorithm(Algorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }


}