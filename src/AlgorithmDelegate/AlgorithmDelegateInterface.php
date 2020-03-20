<?php

namespace Axiom\GeneticAlgorithm\AlgorithmDelegate;
use Axiom\GeneticAlgorithm\Algorithm;

interface AlgorithmDelegateInterface
{
    public function finalSolutionFound(Algorithm $algorithm);
    public function newSolutionFound(Algorithm $algorithm);
    public function algorithmStart(Algorithm $algorithm);
    public function newGeneration($generation);
    public function maxGenerationStagnantReached(Algorithm $algorithm);
    public function algorithmStatus();
}