<?php

namespace GetWith\CoffeeMachine\Domain;

class Drink
{
    private $drink;
    private $sugar;
    private $extraHot;

    public function __construct(string $drinkType, float $money, int $sugars, string $extraHot)
    {
        $this->drink = FactoryDrink::makeDrink($drinkType, $money);
        self::isValidAmountSugar($sugars);
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

    public static function isValidOrder(string $drinkType, float $money, int $sugars): string
    {
        try {
            FactoryDrink::makeDrink($drinkType, $money);
            self::isValidAmountSugar($sugars);
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }

        return '';
    }

    public static function orderedDrinkMessage(string $drinkType, string $extraHot, int $sugars): string
    {
        $dringTypeMessage = 'You have ordered a ' . $drinkType;
        return $dringTypeMessage . self::extraHotMessage($extraHot) . self::amountSugarMessage($sugars);;
    }

    private static function isValidAmountSugar(int $sugars): void
    {
        if ($sugars < 0 || $sugars > 2) {
            throw new DrinkInvalidArgument('The number of sugars should be between 0 and 2.');
        }
    }

    private static function extraHotMessage(string $extraHot): string
    {
        $response = ''; 
        if ($extraHot) {
            $response = ' extra hot';
        }
        return $response;
    }

    private static function amountSugarMessage(string $sugars): string
    {
        $response = '';
        if ($sugars > 0) {
            $response = ' with ' . $sugars . ' sugars (stick included)';
        }
        return $response;
    }
}