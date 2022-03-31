<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Coffee;
use Iterator;

class CoffeeTest extends TestCase
{

    public function validPriceProvider(): iterator
    {
        yield "zero point five" => [0.5];
        yield "ten point two" => [10.2];
        yield "three" => [3];
        yield "zero point seven" => [0.7];
    }

    /** 
     * @test 
     * @dataProvider validPriceProvider
     */
    public function should_create_coffee_when_giving_it_a_higher_or_same_price(float $money): void
    {
        $this->assertTrue((new Coffee($money))->price() <= $money);
    }
}