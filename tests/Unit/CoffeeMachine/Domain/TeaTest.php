<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Tea;
use GetWith\CoffeeMachine\Domain\TeaInvalidArgument;
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

    /** @test */
    public function should_fail_to_create_tea_with_money_less_than_minimun_price(): void
    {
        $this->expectException(TeaInvalidArgument::class);
        new Tea(0.3);
    }

    /** @test */
    public function should_fail_to_create_tea_with_money_less_than_minimun_price_2(): void
    {
        $this->expectException(TeaInvalidArgument::class);
        new Tea(-1.9);
    }

    /** @test */
    public function should_fail_to_create_tea_with_money_less_than_minimun_price_3(): void
    {
        $this->expectException(TeaInvalidArgument::class);
        new Tea(0);
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
        $this->expectException(TeaInvalidArgument::class);
        new Tea($money);
    }
}