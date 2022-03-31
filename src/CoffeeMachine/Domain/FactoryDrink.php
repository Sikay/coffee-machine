<?php

namespace GetWith\CoffeeMachine\Domain;

class FactoryDrink
{
    public static function makeDrink(string $drinkType, float $money): drinkeable
    {
        switch ($drinkType) {
            case 'tea':
                return new Tea($money);

            case 'coffee':
                return new Coffee($money);

            case 'chocolate':
                return new Chocolate($money);

            default:
                throw new DrinkInvalidArgument('The drink type should be tea, coffee or chocolate.');
        }
    }
}