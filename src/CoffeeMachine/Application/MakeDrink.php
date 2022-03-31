<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(string $drinkType, float $money, int $sugars, string $extraHot): string {
        $isValidOrder = Drink::isValidOrder($drinkType, $money, $sugars, $extraHot);
        if (isset($isValidOrder) && !empty($isValidOrder)) {
            return $isValidOrder;
        }

        return Drink::orderedDrinkMessage($drinkType, $extraHot, $sugars);
    }
}