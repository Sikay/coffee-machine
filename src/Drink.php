<?php

namespace GetWith\CoffeeMachine;

class Drink
{
    public static function isValidDrinkType(string $drinkType, float $money): string
    {
        $response = '';
        switch ($drinkType) {
            case 'tea':
                $response = self::isValidTeaPrice($money);
                break;
            case 'coffee':
                $response = self::isValidCoffeePrice($money);
                break;
            case 'chocolate':
                $response = self::isValidChocolatePrice($money);
                break;
            default:
                $response = 'The drink type should be tea, coffee or chocolate.';
        }

        return $response;
    }

    private static function isValidTeaPrice(float $money): string
    {
        $minimunTeaPrice = 0.4;
        if ($money < $minimunTeaPrice) {
            return 'The tea costs 0.4.';
        }
        return '';
    }

    private static function isValidCoffeePrice(float $money): string
    {
        $minimunCoffeePrice = 0.5;
        if ($money < $minimunCoffeePrice) {
            return 'The coffee costs 0.5.';
        }
        return '';
    }

    private static function isValidChocolatePrice(float $money): string
    {
        $minimunChocolatePrice = 0.6;
        if ($money < $minimunChocolatePrice) {
            return 'The chocolate costs 0.6.';
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