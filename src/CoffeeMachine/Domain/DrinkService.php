<?php

namespace GetWith\CoffeeMachine\Domain;

class DrinkService {

    public static function makeDrink(string $drinkType, float $money, int $sugars, string $extraHot): Drink
    {
        return FactoryDrink::makeDrink($drinkType, $money, $sugars, $extraHot);
    }
}