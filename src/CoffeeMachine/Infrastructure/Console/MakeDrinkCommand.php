<?php

namespace GetWith\CoffeeMachine\Infrastructure\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GetWith\CoffeeMachine\Infrastructure\CommandInterface;

class MakeDrinkCommand extends Command
{
    private $commandImplement;
    private const INPUT_ARGUMENT_SYMFONY_CLASS = 'Symfony\Component\Console\Input\InputArgument::';
    private const INPUT_OPTION_SYMFONY_CLASS = 'Symfony\Component\Console\Input\InputOption::VALUE_';

    public function __construct(CommandInterface $commandImplement)
    {
        $this->commandImplement = $commandImplement;
        parent::__construct($commandImplement->command());
    }


    protected function configure(): void
    {
        $configure = $this->commandImplement->configure();

        $this->addCommandArgument($configure);
        $this->addCommandOption($configure);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->commandImplement->execute($input));

        return 0;
    }

    private function addCommandArgument(array $configure): void
    {
        if (array_key_exists('argument', $configure)) {
            foreach ($configure['argument'] as $argument) {
                $this->addArgument(
                    $argument['name'],
                    constant(self::INPUT_ARGUMENT_SYMFONY_CLASS.strtoupper($argument['mode'])),
                    $argument['description'],
                    $argument['default-value']
                );
            }
        }
    }

    private function addCommandOption(array $configure): void
    {
        if (array_key_exists('option', $configure)) {
            foreach ($configure['option'] as $option) {
                $this->addOption(
                    $option['name'],
                    $option['shortcut'],
                    constant(self::INPUT_OPTION_SYMFONY_CLASS.strtoupper($option['mode'])),
                    $option['description'],
                    $option['default-value']
                );
            }
        }
    }

}
