<?php

namespace GetWith\CoffeeMachine\Domain;

class Coffee
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

    private function isValidPrice(float $money): void
    {
        if ($money < self::PRICE) {
            throw new CoffeeInvalidArgument('The coffee costs 0.5.');
        }
    }
}