<h1>
    <img align="left" align="bottom" width="40" height="40" src="resources/images/icons/icon.png" />
    Genetic Algorithm
</h1>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/darvin/genetic-algorithm.svg?style=flat-square)](https://packagist.org/packages/darvin/genetic-algorithm)
[![Quality Score](https://www.code-inspector.com/project/5217/score/svg)](https://frontend.code-inspector.com/public/project/5217/genetic-algorithm/dashboard)
[![Code Grade](https://www.code-inspector.com/project/5217/status/svg)](https://frontend.code-inspector.com/public/project/5217/genetic-algorithm/dashboard)
[![License](https://img.shields.io/github/license/jadenjoy/genetic-algorithm)](https://packagist.org/packages/darvin/genetic-algorithm)

This package allows you to use **Genetic Algorithms** in your **projects**.
It will help high-quality solutions to optimization and search problems by relying on biologically 
inspired operators such as mutation, crossover and selection.

The simplest algorithm represents each chromosome as a bit string. Though it is possible to use any
php data types **Float, String, Booleans, Array, Object**.

---
    
## Installation

You can install the package via composer:

```bash
composer require darvin/genetic-algorithm
```


---
## Usage

#### Settings
Algorithm needs settings to work, so lets starts with the default:

```php
$config = new \Darvin\GeneticAlgorithm\Settings\DefaultSettings();
$algorithm = new Algorithm($config);
```
#### Individual Generation
An individual is characterized by a set of parameters (variables) known as Genes.
Lets say that we encode the genes in a chromosome.

```php
$algorithm->setPart("individual:gene", function (Gene $gene) {
    $characters = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-+,. ');
    $gene->value($characters[rand(0, count($characters)-1)]);
});
```

#### Fitness Function
The fitness function determines how fit an individual is (the ability of an individual
to compete with other individuals). It gives a fitness score to each individual. The
probability that an individual will be selected for reproduction is based on its fitness score.

```php
$algorithm->setPart("fitness", function (Individual $individual) use ($solution) {
    $fitness = 0;
    for ($i=0; $i < $individual->genomeSize() && $i < count($solution); $i++) {
        $char_diff=abs(ord($individual->getGene($i)->value) - ord($solution[$i]));
        $fitness+=$char_diff;
    }
    return $fitness;
});
```

#### Events
You can setup Events to listen and control Algorithm.

##### Algorithm Start
```php
$algorithm->setPart("event:listen:algorithmStart", function (Algorithm $algorithm) {
    echo "Algorithm start.\n";
});
```

##### New Solution
```php
$algorithm->setPart("event:listen:newSolutionFound", function (Algorithm $algorithm) {
    echo "New solution found!";
});
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for further details.

### Security

If you discover any security related issues, please email edeminteractive@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

