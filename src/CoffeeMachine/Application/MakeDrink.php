<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(string $drinkType, float $money, int $sugars, string $extraHot): string {
        try {
            $drink = new Drink($drinkType, $money, $sugars, $extraHot);
            return $drink->order();
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}