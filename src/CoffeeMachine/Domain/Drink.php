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
        $this->sugar = $sugars;
        $this->extraHot = $extraHot;
    }

    public function drink(): Drinkeable
    {
        return $this->drink;
    }

    public static function isValidOrder(string $drinkType, float $money, int $sugars): string
    {
        try {
            FactoryDrink::makeDrink($drinkType, $money);
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }

        if (!self::isValidAmountSugar($sugars)) {
            return 'The number of sugars should be between 0 and 2.';
        }

        return '';
    }

    public static function orderedDrinkMessage(string $drinkType, string $extraHot, int $sugars): string
    {
        $dringTypeMessage = 'You have ordered a ' . $drinkType;
        return $dringTypeMessage . self::extraHotMessage($extraHot) . self::amountSugarMessage($sugars);;
    }

    public static function isValidAmountSugar(int $sugars): bool
    {
        if ($sugars >= 0 && $sugars <= 2) {
            return true;
        }
        return false;
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