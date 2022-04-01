<?php

namespace GetWith\Tests\Unit\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use GetWith\CoffeeMachine\Infrastructure\Console\MakeDrinkCommand;
use GetWith\CoffeeMachine\Infrastructure\DrinkOrder;

class MakeDrinkCommandTest extends TestCase
{
    private $commandImplementMock;
    private $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->commandImplementMock = $this->getMockBuilder(DrinkOrder::class)->getMock();
        $this->commandImplementMock
            ->method('command')
            ->willReturn('fake-command');

        $application = new Application();
        $application->add(new MakeDrinkCommand($this->commandImplementMock));

        $command = $application->find('fake-command');
        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->commandImplementMock = null;
        $this->commandTester = null;
    }

    /** @test */
    public function should_run_command_if_there_are_no_configure(): void
    {
        $commandImplementOutput = 'fake command complete';
        
        $this->commandImplementMock
            ->method('configure')
            ->willReturn([]);
        $this->commandImplementMock
            ->method('execute')
            ->willReturn($commandImplementOutput);
        
        $this->commandTester->execute([]);

        $expectedOutput = $commandImplementOutput . PHP_EOL;
        $output = $this->commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);
    }
}
