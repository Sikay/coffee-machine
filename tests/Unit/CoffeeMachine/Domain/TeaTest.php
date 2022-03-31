<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Tea;
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
}