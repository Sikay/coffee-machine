<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\DrinkService;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDataTransformer;

class MakeDrink
{
    private $drinkDataTransformer;

    public function __construct(DrinkDataTransformer $drinkDataTransformer)
    {
        $this->drinkDataTransformer = $drinkDataTransformer;
    }

    public function execute(MakeDrinkRequest $request): string { 
        $drink = DrinkService::makeDrink(
            $request->drink(),
            $request->money(),
            $request->sugar(),
            $request->extraHot(),
        );

        $this->drinkDataTransformer->write($drink);
        return $this->drinkDataTransformer->read();
    }
}