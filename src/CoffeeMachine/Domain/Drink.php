<?php

namespace GetWith\CoffeeMachine\Domain;

class Drink
{
    private $drink;
    private $sugar;
    private $extraHot;

    public function __construct(string $drinkType, float $money, int $sugars, string $extraHot)
    {
        $this->drink = self::isValidDrinkType($drinkType, $money);
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
            self::isValidDrinkType($drinkType, $money);
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }

        if (!Drink::isValidAmountSugar($sugars)) {
            return 'The number of sugars should be between 0 and 2.';
        }

        return '';
    }

    private static function isValidDrinkType(string $drinkType, float $money): Drinkeable
    {
        switch ($drinkType) {
            case 'tea':
                return new Tea($money);

            case 'coffee':
                return new Coffee($money);

            case 'chocolate':
                return new Chocolate($money);

            default:
                throw new DrinkInvalidArgument('The drink type should be tea, coffee or chocolate.');
        }
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