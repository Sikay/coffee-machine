<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Drink;
use GetWith\CoffeeMachine\Domain\Tea;

class DrinkTest extends TestCase
{
    /** @test */
    public function should_create_a_tea_drink(): void
    {
       $this->assertInstanceOf(Tea::Class, (new Drink('tea', 0.4, '1', ''))->drink()); 
    }
}