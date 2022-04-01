<?php

namespace GetWith\CoffeeMachine\Infrastructure\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GetWith\CoffeeMachine\Infrastructure\DrinkOrder;

class MakeDrinkCommand extends Command
{
    private $commandImplement;

    public function __construct(DrinkOrder $commandImplement)
    {
        $this->commandImplement = $commandImplement;
        parent::__construct($commandImplement->command());
    }


    protected function configure(): void
    {
        $configure = $this->commandImplement->configure();

        foreach ($configure['argument'] as $argument) {
            $this->addArgument(
                $argument['name'],
                constant('Symfony\Component\Console\Input\InputArgument::'.strtoupper($argument['mode'])),
                $argument['description'],
                $argument['default-value']
            );
        }

        foreach ($configure['option'] as $option) {
            $this->addOption(
                $option['name'],
                $option['shortcut'],
                constant('Symfony\Component\Console\Input\InputOption::VALUE_'.strtoupper($argument['mode'])),
                $option['description'],
                $option['default-value']
            );
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->commandImplement->execute($input));

        return 0;
    }

}
