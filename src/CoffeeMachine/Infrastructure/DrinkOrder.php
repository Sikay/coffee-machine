<?php

namespace GetWith\CoffeeMachine\Infrastructure;

use Symfony\Component\Console\Input\InputInterface;
use GetWith\CoffeeMachine\Application\MakeDrink;
use GetWith\CoffeeMachine\Application\MakeDrinkRequest;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDtoDataTransformer;

class DrinkOrder
{
    private const COMMAND = 'app:order-drink';

    public function command(): string
    {
        return self::COMMAND;
    }

    public function configure(): array
    {
        return [
            'argument' => [
                'drink-type' => [
                    'name'          => 'drink-type',
                    'mode'          => 'REQUIRED',
                    'description'   => 'The type of the drink. (Tea, Coffee or Chocolate)',
                    'default-value' => null
                ],
                'money' => [
                    'name'          => 'money',
                    'mode'          => 'REQUIRED',
                    'description'   => 'The amount of money given by the user',
                    'default-value' => null
                ],
                'sugars' => [
                    'name'          => 'sugars',
                    'mode'          => 'OPTIONAL',
                    'description'   => 'The number of sugars you want. (0, 1, 2)',
                    'default-value' => 0
                ],
            ],
            'option' => [
                'extra-hot' => [
                    'name'          => 'extra-hot',
                    'shortcut'      => 'e',
                    'mode'          => 'NONE',
                    'description'   => 'The number of sugars you want. (0, 1, 2)',
                    'default-value' => null
                ]
            ]
        ];
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
