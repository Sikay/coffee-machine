<?php

namespace GetWith\CoffeeMachine\Domain;

class Chocolate implements Drinkeable 
{
    private const NAME = 'chocolate';
    private const PRICE = 0.6;

    public function __construct(float $money)
    {
        $this->isValidPrice($money);
    }

    public function price(): float
    {
        return self::PRICE;
    }

    public function name(): string
    {
        return self::NAME;
    }

    private function isValidPrice(float $money): void
    {
        if ($money < self::PRICE) {
            throw new DrinkInvalidArgument('The chocolate costs 0.6.');
        }
    }
}