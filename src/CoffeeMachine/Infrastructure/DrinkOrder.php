<?php

namespace GetWith\CoffeeMachine\Infrastructure;

use Symfony\Component\Console\Input\InputInterface;
use GetWith\CoffeeMachine\Application\MakeDrink;
use GetWith\CoffeeMachine\Application\MakeDrinkRequest;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDtoDataTransformer;

class DrinkOrder implements CommandInterface
{
    private const COMMAND = 'app:order-drink';

    public function command(): string
    {
        return self::COMMAND;
    }

    public function configure(): array
    {
        return include 'OrderConfigureCommand.php';
    }

    public function execute(InputInterface $input): string
    {
        $drinkType = strtolower($input->getArgument('drink-type'));
        $money = floatval($input->getArgument('money'));
        $sugars = intval($input->getArgument('sugars'));
        $extraHot = $input->getOption('extra-hot');

        $orderRequestDTO = new MakeDrinkRequest($drinkType, $money, $sugars, $extraHot);
        $makeDrink = new MakeDrink(new DrinkDtoDataTransformer());

        try {  
            return $makeDrink->execute($orderRequestDTO);
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}
