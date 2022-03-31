<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Coffee;
use GetWith\CoffeeMachine\Domain\CoffeeInvalidArgument;
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

    public function invalidPriceProvider(): iterator
    {
        yield "zero point three" => [0.3];
        yield "minus one point nine" => [-1.9];
        yield "zero" => [0];
    }

    /** 
     * @test 
     * @dataProvider invalidPriceProvider
     */
    public function should_fail_to_create_coffee_with_money_less_than_minimun_price_required(float $money): void
    {
        $this->expectException(CoffeeInvalidArgument::class);
        new Coffee($money);
    }

    /** @test */
    public function should_create_coffee_and_return_its_correct_name(): void
    {
        $this->assertSame((new Coffee(0.5))->name(), 'coffee');
    }
}