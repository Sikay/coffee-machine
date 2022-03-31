<?php

namespace GetWith\Tests\Unit\CoffeeMachine\Application;

use PHPUnit\Framework\TestCase;
use GetWith\CoffeeMachine\Application\MakeDrink;
use GetWith\CoffeeMachine\Application\MakeDrinkRequest;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDtoDataTransformer;

class MakeDrinkTest extends TestCase
{
    private $makeDrink;

    public function setUp(): void
    {
        $this->makeDrink = new MakeDrink(new DrinkDtoDataTransformer());
    }

    /** 
    * @test
    * @dataProvider ordersProvider
    *  */
    public function should_returns_the_expected_output(string $drinkType, float $money, int $sugars, string $extraHot, string $expectedOutput): void
    {
        $orderRequestDTO = new MakeDrinkRequest($drinkType, $money, $sugars, $extraHot);
        $this->assertSame($this->makeDrink->execute($orderRequestDTO), $expectedOutput);
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
        ];
    }

    /** 
     * @test
     * @dataProvider notValidOrdersProvider
     *  */
    public function should_fail_to_make_drink_and_returns_exception(string $drinkType, float $money, int $sugars, string $extraHot): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $orderRequest = new MakeDrinkRequest($drinkType, $money, $sugars, $extraHot);
        $this->makeDrink->execute($orderRequest);
    }

    public function notValidOrdersProvider(): array
    {
        return [
            [
                'coffee', 0.2, 2, '1',
            ],
            [
                'chocolate', 0.3, 2, '1',
            ],
            [
                'tea', 0.1, 2, '1',
            ],
            [
                'tea', 0.5, -1, '1',
            ],
            [
                'tea', 0.5, 3, '1',
            ],
            [
                'milk', 0.5, 1, '1',
            ],
            [
                'milk', 0.8, -1, '',
            ],
            [
                '', 0, 0, '',
            ],
        ];
    }
}