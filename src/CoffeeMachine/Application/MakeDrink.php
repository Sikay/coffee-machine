<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\DrinkService;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDtoDataTransformer;

class MakeDrink
{
    private $drinkDataTransformer;

    public function __construct(DrinkDtoDataTransformer $drinkDataTransformer)
    {
        $this->drinkDataTransformer = $drinkDataTransformer;
    }

    public function execute(MakeDrinkRequest $request): string {
        try {  
            $drink = DrinkService::makeDrink(
                $request->drink(),
                $request->money(),
                $request->sugar(),
                $request->extraHot(),
            );

            $this->drinkDataTransformer->write($drink);
            return $this->drinkDataTransformer->read();

        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}