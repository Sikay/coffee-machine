<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Drink;
use GetWith\CoffeeMachine\Domain\Tea;
use GetWith\CoffeeMachine\Domain\Coffee;
use GetWith\CoffeeMachine\Domain\Chocolate;

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
}