<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\DrinkService;
use GetWith\CoffeeMachine\Application\DataTransformer\DrinkDtoDataTransformer;

class MakeDrink
{
    public function execute(MakeDrinkRequest $request): string {
        try {  
            $drink = DrinkService::makeDrink(
                $request->drink(),
                $request->money(),
                $request->sugar(),
                $request->extraHot(),
            );

            $drinkDTO = new DrinkDtoDataTransformer();
            $drinkDTO->write($drink);
            return $drinkDTO->read();

        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}