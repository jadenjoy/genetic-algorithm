<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 04:57
 */
namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\AlgorithmDelegate\AlgorithmDelegate;

class ExampleDelegate extends AlgorithmDelegate {

    public $starttime = 0;

    public function algorithmStart(Algorithm $algorithm)
    {
        $this->starttime = microtime(true);
    }

    public function finalSolutionFound(Algorithm $algorithm)
    {
        $execution_time = (microtime(true) - $this->starttime);
        echo "Время поиска:".$execution_time."\n";
        $fittest = $algorithm->getPopulation()->getFittest();
        echo "Закончено. Найдено решение: ".implode("", $fittest->getGenome())."\n";
    }

    public function newSolutionFound(Algorithm $algorithm)
    {
        $fittest = $algorithm->getPopulation()->getFittest();
        $genome = $fittest->getGenome();
        echo "Найдено новое решение: ".implode("", $genome)."\n";
    }

    public function maxGenerationStagnantReached(Algorithm $algorithm)
    {
        echo "Достигнут предел стагнации поколений\n";
        echo "Обнуляем.... =)\n";
        $algorithm->resetGenerationStagnant();
        // Увеличиваем мутации
        $algorithm->getSettings()->poolSize += 10;
        $this->setStatus(Algorithm::ALGORITHM_STATUS_CONTINUE);
    }
}