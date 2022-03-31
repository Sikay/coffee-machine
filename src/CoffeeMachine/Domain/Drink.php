<?php

namespace GetWith\CoffeeMachine\Domain;

class Drink
{
    private $drink;
    private $sugar;
    private $extraHot;

    private const MINIMUN_AMOUNT_SUGAR = 0;
    private const MAXIMUN_AMOUNT_SUGAR = 2;

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

    private static function isValidAmountSugar(int $sugars): void
    {
        if ($sugars < self::MINIMUN_AMOUNT_SUGAR || $sugars > self::MAXIMUN_AMOUNT_SUGAR) {
            throw new DrinkInvalidArgument('The number of sugars should be between 0 and 2.');
        }
    }

    public static function orderedDrinkMessage(string $drinkType, string $extraHot, int $sugars): string
    {
        $dringTypeMessage = 'You have ordered a ' . $drinkType;
        return $dringTypeMessage . self::extraHotMessage($extraHot) . self::amountSugarMessage($sugars);;
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
        if ($sugars > self::MINIMUN_AMOUNT_SUGAR) {
            $response = ' with ' . $sugars . ' sugars (stick included)';
        }
        return $response;
    }
}