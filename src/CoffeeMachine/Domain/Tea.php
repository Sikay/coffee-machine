<?php

namespace GetWith\CoffeeMachine\Domain;

class Tea
{
    private const NAME = 'tea';
    private const PRICE = 0.4;

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
            throw new TeaInvalidArgument('The tea costs 0.4.');
        }
    }
}