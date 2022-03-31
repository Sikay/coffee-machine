<?php

namespace GetWith\CoffeeMachine\Domain;

use GetWith\CoffeeMachine\Domain\ChocolateInvalidArgument;

class Chocolate
{
    private const NAME = 'chocolate';
    private const PRICE = 0.6;

    public function __construct(float $money)
    {
        if ($money < self::PRICE) {
            throw new Exception('The chocolate costs 0.6.');
        }
    }

    public function price(): float
    {
        return self::PRICE;
    }
}