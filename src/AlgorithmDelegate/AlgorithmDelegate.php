<?php

namespace Darvin\GeneticAlgorithm\AlgorithmDelegate;
use Darvin\GeneticAlgorithm\Algorithm;


class AlgorithmDelegate implements AlgorithmDelegateInterface
{


    private $algorithmStatus = Algorithm::ALGORITHM_STATUS_NO_STATUS;

    // Найдено решение
    public function finalSolutionFound(Algorithm $algorithm)
    {
        //
    }

    // Найдено новое решение
    public function newSolutionFound(Algorithm $algoithm)
    {
        //
    }



    // Алгоритм начал работу
    public function algorithmStart(Algorithm $algorithm)
    {
        //
    }

    // Новое поколение
    public function newGeneration($generation)
    {
        //
    }

    public function maxGenerationStagnantReached(Algorithm $algorithm)
    {
        //
    }

    public function algorithmStatus()
    {
        return $this->algorithmStatus;
    }


    function setStatus($status)
    {
        $this->algorithmStatus = $status;
    }


}