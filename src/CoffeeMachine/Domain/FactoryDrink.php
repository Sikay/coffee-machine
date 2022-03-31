<?php

namespace GetWith\CoffeeMachine\Domain;

class FactoryDrink
{
    public static function makeDrink(string $drinkType, float $money): drinkeable
    {
        $drinks = [
            'tea'       => Tea::class,
            'coffee'    => Coffee::class,
            'chocolate' => Chocolate::class
        ];

        if (!array_key_exists($drinkType, $drinks)) {
            throw new DrinkInvalidArgument('The drink type should be tea, coffee or chocolate.');
        }
        
        return new $drinks[$drinkType]($money);
    }
}