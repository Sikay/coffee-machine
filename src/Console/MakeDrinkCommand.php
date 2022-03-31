<?php

namespace GetWith\CoffeeMachine\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GetWith\CoffeeMachine\Drink;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    public function __construct()
    {
        parent::__construct(MakeDrinkCommand::$defaultName);
    }


    protected function configure(): void
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $drinkType = strtolower($input->getArgument('drink-type'));
        $money = floatval($input->getArgument('money'));

        $isValidDrinkType = Drink::isValidDrinkType($drinkType, $money);

        if (isset($isValidDrinkType) && !empty($isValidDrinkType)) {
            $output->writeln($isValidDrinkType);
            return 0;
        }

        $sugars = $input->getArgument('sugars');
        $stick = false;
        $extraHot = $input->getOption('extra-hot');
        if ($sugars >= 0 && $sugars <= 2) {
            $output->write('You have ordered a ' . $drinkType);
            if ($extraHot) {
                $output->write(' extra hot');
            }

            if ($sugars > 0) {
                $stick = true;
                $output->write(' with ' . $sugars . ' sugars (stick included)');
            }
            $output->writeln('');
        } else {
            $output->writeln('The number of sugars should be between 0 and 2.');
        }

        return 0;
    }
}
