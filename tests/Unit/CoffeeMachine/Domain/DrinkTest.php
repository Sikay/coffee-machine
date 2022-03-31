<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
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
        $drink = FactoryDrink::makeDrink('tea', 0.4,'1', '');
        $this->assertInstanceOf(Tea::Class, $drink->drink()); 
    }

    /** @test */
    public function should_create_a_coffee_drink(): void
    {
        $drink = FactoryDrink::makeDrink('coffee', 0.5, '1', '');
        $this->assertInstanceOf(Coffee::Class, $drink->drink());
    }

    /** @test */
    public function should_create_a_chocolate_drink(): void
    {
        $drink = FactoryDrink::makeDrink('chocolate', 0.6, '1', '');
        $this->assertInstanceOf(Chocolate::Class, $drink->drink());
    }

    /** @test */
    public function should_fail_to_create_Drink_with_incorrect_parameters(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        FactoryDrink::makeDrink('milk', 0.1, '1', '');
    }

    /** @test */
    public function should_create_a_drink_with_zero_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('chocolate', 0.6, '0', '');
        $this->assertTrue($drink->sugar() === 0);
    }

    /** @test */
    public function should_create_a_drink_with_one_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('coffee', 0.9, '1', '');
        $this->assertTrue($drink->sugar() === 1);
    }

    /** @test */
    public function should_create_a_drink_with_two_sugars(): void
    {
        $drink = FactoryDrink::makeDrink('tea', 0.7, '2', '');
        $this->assertTrue($drink->sugar() === 2);
    }

    /** @test */
    public function should_fail_to_create_a_drink_with_three_sugars(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        $drink = FactoryDrink::makeDrink('tea', 0.4, '3', '');
    }

    /** @test */
    public function should_fail_to_create_a_drink_with_minus_one_sugars(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        $drink = FactoryDrink::makeDrink('tea', 0.4, '-1', '');
    }
}