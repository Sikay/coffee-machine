<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Domain;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Domain\Tea;

class TeaTest extends TestCase
{
    /** @test */
    public function should_create_tea_when_giving_it_a_higher_price(): void
    {
        $higherPrice = 0.5;
        $tea = new Tea($higherPrice);
        $this->assertTrue($tea->price() <= $higherPrice);
    }
}