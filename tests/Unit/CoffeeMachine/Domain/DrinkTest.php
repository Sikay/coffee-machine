<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Drink;
use GetWith\CoffeeMachine\Domain\Tea;
use GetWith\CoffeeMachine\Domain\Coffee;
use GetWith\CoffeeMachine\Domain\Chocolate;
use GetWith\CoffeeMachine\Domain\DrinkInvalidArgument;

class DrinkTest extends TestCase
{
    /** @test */
    public function should_create_a_tea_drink(): void
    {
       $this->assertInstanceOf(Tea::Class, (new Drink('tea', 0.4, '1', ''))->drink()); 
    }

    /** @test */
    public function should_create_a_coffee_drink(): void
    {
        $this->assertInstanceOf(Coffee::Class, (new Drink('coffee', 0.5, '1', ''))->drink());
    }

    /** @test */
    public function should_create_a_chocolate_drink(): void
    {
        $this->assertInstanceOf(Chocolate::Class, (new Drink('chocolate', 0.6, '1', ''))->drink());
    }

    /** @test */
    public function should_fail_to_create_Drink_with_incorrect_parameters(): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        new Drink('milk', 0.1, '1', '');
    }

    /** @test */
    public function should_create_a_drink_with_correct_amount_of_sugars(): void
    {
        $this->assertTrue((new Drink('chocolate', 0.6, '0', ''))->sugar() === 0);
    }
}