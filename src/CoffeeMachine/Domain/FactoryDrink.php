<?php

namespace GetWith\CoffeeMachine\Domain;

class FactoryDrink
{
    public static function makeDrink(string $drinkType, float $money, int $sugars, string $extraHot): Drink
    {
        $allDrinks = include 'DrinkType.php';

        if (!array_key_exists($drinkType, $allDrinks)) {
            throw new DrinkInvalidArgument('The drink type should be tea, coffee or chocolate.');
        }
        
        $drink = new $allDrinks[$drinkType]($money);

        return new Drink($drink, $sugars, $extraHot);
    }
}