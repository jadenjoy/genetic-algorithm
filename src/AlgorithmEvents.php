<?php

namespace Darvin\GeneticAlgorithm;

/**
 * Class AlgorithmEvents
 * @package Darvin\GeneticAlgorithm
 */
class AlgorithmEvents
{

    /**
     * @var array
     */
    private $events = [];

    /**
     * @param $name
     * @param $closure
     */
    public function create($name, $closure)
    {
        $this->events[$name] = $closure;
    }

    /**
     * @param $name
     * @param $param
     */
    public function trigger($name, $param)
    {
        if (isset($this->events[$name])) {
            ($this->events[$name])($param);
        }
    }

    /**
     * @param $closure
     * @param $name
     */
    public function setListenPart($closure, $name)
    {
        $this->create($name, $closure);
    }



}