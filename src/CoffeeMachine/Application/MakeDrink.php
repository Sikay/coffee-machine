<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(string $drinkType, float $money, int $sugars, string $extraHot): string {
        try {
            new Drink($drinkType, $money, $sugars, $extraHot);
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }

        return Drink::orderedDrinkMessage($drinkType, $extraHot, $sugars);
    }
}