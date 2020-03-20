<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 19.03.2020
 * Time: 02:10
 */
namespace Axiom\GeneticAlgorithm\Fitness;
use Axiom\GeneticAlgorithm\Individual\IndividualInterface;

class DefaultFitness extends AbstractFitness {

    public $solution =  array();

    function setSolution($newSolution) {
        // Loop through each character of our string and save it in our string  array
        $this->solution=str_split($newSolution);
    }

    // Calculate individuals fitness by comparing it to our candidate solution
    // low fitness values are better,0=goal fitness is really a cost function in this instance
    function  getFitness(IndividualInterface $individual) {
        $fitness = 0;
        $sol_count=count($this->solution);  /* get array size */


        // Loop through our individuals genes and compare them to our candidates
        for ($i=0; $i < $individual->genomeSize() && $i < $sol_count; $i++ )
        {
            $char_diff=0;
            //compare genes and note the difference using ASCII value vs. solution Ascii value note the difference
            $char_diff=abs( ord($individual->getGene($i)) - ord($this->solution[$i]) ) ;
            //$char_fitness=($individual->getGene($i)==fitnesscalc::$solution[$i])?1:0; //if exact match add 1 to fitness
            $fitness+=$char_diff; // low fitness values are better,
        }

        return $fitness;  //inverse of cost function

    }

    // Get optimum fitness
    function getMaxFitness() {
        return 0;
    }
}