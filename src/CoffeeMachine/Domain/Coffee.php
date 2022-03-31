<?php

namespace GetWith\CoffeeMachine\Domain;

class Coffee
{
    private const NAME = 'coffee';
    private const PRICE = 0.5;

    public function __construct(float $money)
    {
        if ($money < self::PRICE) {
            throw new Exception('The coffee costs 0.5.');
        }
    }

    public function price(): float
    {
        return self::PRICE;
    }
}