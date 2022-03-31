<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(string $drinkType, float $money, int $sugars, string $extraHot): string {
        return Drink::orderedDrinkMessage($drinkType, $extraHot, $sugars);
    }
}