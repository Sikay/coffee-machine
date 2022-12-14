<?php

namespace GetWith\Tests\Integration\Console;

use GetWith\CoffeeMachine\Infrastructure\Console\BaseCommand;
use GetWith\CoffeeMachine\Infrastructure\DrinkOrder;
use GetWith\Tests\Integration\IntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class MakeDrinkCommandTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->application->add(new BaseCommand(new DrinkOrder()));
    }

    /**
     * @dataProvider ordersProvider
     * @param string $drinkType
     * @param string $money
     * @param int $sugars
     * @param string $extraHot
     * @param string $expectedOutput
     */
    public function test_coffee_machine_returns_the_expected_output(
        string $drinkType,
        string $money,
        int $sugars,
        string $extraHot,
        string $expectedOutput
    ): void {
        $command = $this->application->find('app:order-drink');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'drink-type' => $drinkType,
            'money' => $money,
            'sugars' => $sugars,
            '--extra-hot' => $extraHot
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', '0.7', 1, '', 'You have ordered a chocolate with 1 sugars (stick included)' . PHP_EOL
            ],
            [
                'tea', '0.4', 0, '1', 'You have ordered a tea extra hot' . PHP_EOL
            ],
            [
                'coffee', '2', 2, '1', 'You have ordered a coffee extra hot with 2 sugars (stick included)' . PHP_EOL
            ],
            [
                'coffee', '0.2', 2, '1', 'The coffee costs 0.5.' . PHP_EOL
            ],
            [
                'chocolate', '0.3', 2, '1', 'The chocolate costs 0.6.' . PHP_EOL
            ],
            [
                'tea', '0.1', 2, '1', 'The tea costs 0.4.' . PHP_EOL
            ],
            [
                'tea', '0.5', -1, '1', 'The number of sugars should be between 0 and 2.' . PHP_EOL
            ],
            [
                'tea', '0.5', 3, '1', 'The number of sugars should be between 0 and 2.' . PHP_EOL
            ],
            [
                'milk', '0.5', 1, '1', 'The drink type should be tea, coffee or chocolate.' . PHP_EOL
            ],
            [
                'milk', '0.8', -1, '', 'The drink type should be tea, coffee or chocolate.' . PHP_EOL
            ],
            [
                '', '', 0, '', 'The drink type should be tea, coffee or chocolate.' . PHP_EOL
            ],
        ];
    }
}
