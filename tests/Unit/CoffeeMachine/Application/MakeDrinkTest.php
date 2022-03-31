<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Application;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Application\MakeDrink;
use GetWith\CoffeeMachine\Application\MakeDrinkRequest;

class MakeDrinkTest extends TestCase
{
    /** 
    * @test
    * @dataProvider ordersProvider
    *  */
    public function should_returns_the_expected_output(string $drinkType, float $money, int $sugars, string $extraHot, string $expectedOutput): void
    {
        $orderRequestDTO = new MakeDrinkRequest($drinkType, $money, $sugars, $extraHot);
        $this->assertSame((new MakeDrink())->execute($orderRequestDTO), $expectedOutput);
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', 0.7, 1, '', 'You have ordered a chocolate with 1 sugars (stick included)',
            ],
            [
                'tea', 0.4, 0, '1', 'You have ordered a tea extra hot',
            ],
            [
                'coffee', 2, 2, '1', 'You have ordered a coffee extra hot with 2 sugars (stick included)',
            ],
            [
                'coffee', 0.2, 2, '1', 'The coffee costs 0.5.',
            ],
            [
                'chocolate', 0.3, 2, '1', 'The chocolate costs 0.6.',
            ],
            [
                'tea', 0.1, 2, '1', 'The tea costs 0.4.',
            ],
            [
                'tea', 0.5, -1, '1', 'The number of sugars should be between 0 and 2.',
            ],
            [
                'tea', 0.5, 3, '1', 'The number of sugars should be between 0 and 2.',
            ],
            [
                'milk', 0.5, 1, '1', 'The drink type should be tea, coffee or chocolate.',
            ],
            [
                'milk', 0.8, -1, '', 'The drink type should be tea, coffee or chocolate.',
            ],
            [
                '', 0, 0, '', 'The drink type should be tea, coffee or chocolate.',
            ],
        ];
    }
}