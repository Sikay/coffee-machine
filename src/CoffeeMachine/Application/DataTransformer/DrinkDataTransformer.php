<?php

namespace GetWith\CoffeeMachine\Application\DataTransformer;

use GetWith\CoffeeMachine\Domain\Drink;

interface DrinkDataTransformer
{
    public function write(Drink $drink);

    public function read();
}