<?php
namespace Darvin\GeneticAlgorithm;

/**
 * Class PartBuilder
 * @package Darvin\GeneticAlgorithm
 */
class PartBuilder extends AlgorithmPart
{


    /**
     * @param $part
     * @param $closure
     */
    public function setPart($part, $closure)
    {
        $vars = explode(":", $part);
        $provider = $this->getProvider($vars[0]);
        $part = isset($vars[1]) ? $vars[1] : "main";
        unset($vars[0], $vars[1]);

        $params = array_merge([$closure], $vars);

        if (!is_null($provider)) {
            $handler = [$provider, 'set'.ucfirst($part).'Part'];

            if (is_callable($handler)) {
                call_user_func_array($handler, $params);
            }
        }
    }

    /**
     * Возвращает провайдеры
     * @param $provider
     * @return mixed|null
     */
    public function getProvider($provider)
    {

        $providers = [
            "individual" => $this->algorithm->getIndividual(),
            "mutation" => $this->algorithm->getMutation(),
            "fitness" => $this->algorithm->getFitness(),
            "event" => $this->algorithm->getEvents()
        ];

        return isset($providers[$provider]) ? $providers[$provider] : null;
    }
}
