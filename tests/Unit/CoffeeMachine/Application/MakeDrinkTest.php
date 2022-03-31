<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Application;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Application\MakeDrink;

class MakeDrinkTest extends TestCase
{
    /** @test */
    public function should_make_drink_with_valid_argument(): void
    {
        $this->assertSame((new MakeDrink())->execute('chocolate', '0.7', 1, ''), 'You have ordered a chocolate with 1 sugars (stick included)');
    }
}