<?php

namespace GetWith\CoffeeMachine\Application;

class MakeDrinkRequest
{
    private $drink;
    private $money;
    private $sugar;
    private $extraHot;

    public function __construct(string $drink, float $money, int $sugar, string $extraHot) 
    {
        $this->drink = $drink;
        $this->money = $money;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
    }

    public function drink(): string
    {
        return $this->drink;
    }

    public function money(): float
    {
        return $this->money;
    }

    public function sugar(): int
    {
        return $this->sugar;
    }

    public function extraHot(): string
    {
        return $this->extraHot;
    }
}