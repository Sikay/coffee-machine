<?php

namespace GetWith\CoffeeMachine\Application\DataTransformer;

use GetWith\CoffeeMachine\Domain\Drink;

class DrinkDtoDataTransformer implements DrinkDataTransformer
{
    private $drink;

    public function write(Drink $drink)
    {
        $this->drink = $drink;

        return $this;
    }

    public function read()
    {
        return $this->drink->order();
    }
}