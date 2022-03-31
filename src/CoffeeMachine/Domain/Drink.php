<?php

namespace GetWith\CoffeeMachine\Domain;

class Drink
{
    private $drink;
    private $sugar;
    private $extraHot;

    private const MINIMUN_AMOUNT_SUGAR = 0;
    private const MAXIMUN_AMOUNT_SUGAR = 2;

    public function __construct(Drinkeable $drink, int $sugars, string $extraHot)
    {
        self::isValidAmountSugar($sugars);
        $this->drink = $drink;
        $this->sugar = $sugars;
        $this->extraHot = $extraHot;
    }

    public function drink(): Drinkeable
    {
        return $this->drink;
    }

    public function sugar(): int
    {
        return $this->sugar;
    }

    public function name(): string
    {
        return $this->drink->name();
    }

    private static function isValidAmountSugar(int $sugars): void
    {
        if ($sugars < self::MINIMUN_AMOUNT_SUGAR || $sugars > self::MAXIMUN_AMOUNT_SUGAR) {
            throw new DrinkInvalidArgument('The number of sugars should be between 0 and 2.');
        }
    }

    public function order(): string
    {
        $dringTypeMessage = 'You have ordered a ' . $this->name();
        return $dringTypeMessage . $this->extraHotMessage() . $this->amountSugarMessage();;
    }

    private function extraHotMessage(): string
    {
        $response = ''; 
        if ($this->extraHot) {
            $response = ' extra hot';
        }
        return $response;
    }

    private function amountSugarMessage(): string
    {
        $response = '';
        if ($this->sugar > self::MINIMUN_AMOUNT_SUGAR) {
            $response = ' with ' . $this->sugar . ' sugars (stick included)';
        }
        return $response;
    }
}