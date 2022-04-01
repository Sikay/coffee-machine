<?php

namespace GetWith\CoffeeMachine\Domain;

class Coffee implements Drinkeable
{
    private const NAME = 'coffee';
    private const PRICE = 0.5;

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
            throw new DrinkInvalidArgument('The coffee costs 0.5.');
        }
    }
}