<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Chocolate;
use GetWith\CoffeeMachine\Domain\ChocolateInvalidArgument;
use Iterator;

class ChocolateTest extends TestCase
{

    public function validPriceProvider(): iterator
    {
        yield "zero point six" => [0.6];
        yield "ten point two" => [10.2];
        yield "three" => [3];
        yield "zero point nine" => [0.9];
    }

    /** 
     * @test 
     * @dataProvider validPriceProvider
     */
    public function should_create_chocolate_when_giving_it_a_higher_or_same_price(float $money): void
    {
        $this->assertTrue((new Chocolate($money))->price() <= $money);
    }

    public function invalidPriceProvider(): iterator
    {
        yield "zero point three" => [0.3];
        yield "minus one point nine" => [-1.9];
        yield "zero" => [0];
        yield "zero point five" => [0.5];
    }

    /** 
     * @test 
     * @dataProvider invalidPriceProvider
     */
    public function should_fail_to_create_chocolate_with_money_less_than_minimun_price_required(float $money): void
    {
        $this->expectException(ChocolateInvalidArgument::class);
        new Chocolate($money);
    }

    /** @test */
    public function should_create_chocolate_and_return_its_correct_name(): void
    {
        $this->assertSame((new Chocolate(0.6))->name(), 'chocolate');
    }
}