<?php

namespace GetWith\CoffeeMachine\Domain;

class Tea
{
    private const NAME = 'tea';
    private const PRICE = 0.4;

    public function __construct(float $money)
    {
        if ($money < self::PRICE) {
            throw new Exception();
        }
    }

    public function price(): float
    {
        return self::PRICE;
    }
}