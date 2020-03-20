<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 01:59
 */
namespace Axiom\GeneticAlgorithm\Individual;

class DefaultIndividual extends AbstractIndividual {


    //public $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-+,. ';
    public $characters = '10';


    public function generateIndividual($genomeSize)
    {
        //now lets randomly load the genes (array of ascii characters)	 to the size of the array
        for ($i=0; $i < $genomeSize; $i++ ) {
            $this->genes[$i] = $this->characters[rand(0, strlen($this->characters) - 1)];
        }

    }

    public function randomGene()
    {
        return $this->characters[rand(0, strlen($this->characters) - 1)];
    }


}