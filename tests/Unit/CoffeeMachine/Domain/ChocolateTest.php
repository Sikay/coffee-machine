<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Chocolate;
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
}