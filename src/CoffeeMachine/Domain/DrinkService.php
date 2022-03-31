<?php

namespace GetWith\CoffeeMachine\Domain;

class DrinkService {

    public static function makeDrink(string $drinkType, float $money, int $sugars, string $extraHot): Drink
    {
        $drink = FactoryDrink::makeDrink($drinkType, $money);
        return new Drink($drink, $sugars, $extraHot);
    }
}