<?php

namespace Darvin\GeneticAlgorithm;

use Darvin\GeneticAlgorithm\Contracts\GeneInterface;

/**
 * Class Gene
 * @package Darvin\GeneticAlgorithm
 */
class Gene implements GeneInterface
{
    /**
     * @var mixed $value Значение гена
     */
    public $value;
    /**
     * @var mixed $params Параметры гена
     */
    public $params;


    /**
     * @param $value
     * @return mixed
     */
    public function value($value)
    {
        $this->value = $value;
        return $this->value;
    }


    /**
     * @param $param
     * @return mixed
     */
    public function param($param)
    {
        $this->params = $param;
        return $this->params;
    }
}
