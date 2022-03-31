<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Drink;
use GetWith\CoffeeMachine\Domain\Tea;
use GetWith\CoffeeMachine\Domain\Coffee;
use GetWith\CoffeeMachine\Domain\Chocolate;
use GetWith\CoffeeMachine\Domain\DrinkInvalidArgument;
use GetWith\CoffeeMachine\Domain\FactoryDrink;

class DrinkTest extends TestCase
{
    /** @test */
    public function should_create_a_tea_drink(): void
    {
        $drink = FactoryDrink::makeDrink('tea', 0.4);
        $this->assertInstanceOf(Tea::Class, (new Drink($drink, '1', ''))->drink()); 
    }

    /** @test */
    public function should_create_a_coffee_drink(): void
    {
        $drink = FactoryDrink::makeDrink('coffee', 0.5);
        $this->assertInstanceOf(Coffee::Class, (new Drink($drink, '1', ''))->drink());
    }

    /** @test */
    public function should_create_a_chocolate_drink(): void
    {
        $drink = FactoryDrink::makeDrink('chocolate', 0.6);
        $this->assertInstanceOf(Chocolate::Class, (new Drink($drink, '1', ''))->drink());
    }

    /** @test */
    public function should_fail_to_create_Drink_with_incorrect_parameters(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        FactoryDrink::makeDrink('milk', 0.1);
    }

    /** @test */
    public function should_create_a_drink_with_zero_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('chocolate', 0.6);
        $this->assertTrue((new Drink($drink, '0', ''))->sugar() === 0);
    }

    /** @test */
    public function should_create_a_drink_with_one_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('coffee', 0.9);
        $this->assertTrue((new Drink($drink, '1', ''))->sugar() === 1);
    }

    /** @test */
    public function should_create_a_drink_with_two_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('tea', 0.7);
        $this->assertTrue((new Drink($drink, '2', ''))->sugar() === 2);
    }

    /** @test */
    public function should_fail_to_create_a_drink_with_three_sugars(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        $drink = FactoryDrink::makeDrink('tea', 0.4);
        new Drink($drink, '3', '');
    }

    /** @test */
    public function should_fail_to_create_a_drink_with_minus_one_sugars(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        $drink = FactoryDrink::makeDrink('tea', 0.4);
        new Drink($drink, '-1', '');
    }
}