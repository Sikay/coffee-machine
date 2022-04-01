<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Tea;
use GetWith\CoffeeMachine\Domain\DrinkInvalidArgument;
use Iterator;

class TeaTest extends TestCase
{
    public function validPriceProvider(): iterator
    {
        yield "zero point five" => [0.5];
        yield "ten point two" => [10.2];
        yield "three" => [3];
        yield "zero point four" => [0.4];
    }

    /** 
     * @test 
     * @dataProvider validPriceProvider
     * */
    public function should_create_tea_when_giving_it_a_higher_or_same_price(float $money): void
    {
        $this->assertTrue((new Tea($money))->price() <= $money);
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
    public function should_fail_to_create_tea_with_money_less_than_minimun_price_required(float $money): void
    {
        $this->expectException(DrinkInvalidArgument::class);
        new Tea($money);
    }

    /** @test */
    public function should_create_tea_and_return_its_correct_name(): void
    {
        $this->assertSame((new Tea(0.4))->name(), 'tea');
    }
}