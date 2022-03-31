<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(MakeDrinkRequest $request): string {
        try {  
            return DrinkService::makeDrink(
                $request->drink(),
                $request->money(),
                $request->sugar(),
                $request->extraHot(),
            )->order();
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}