<?php

namespace GetWith\CoffeeMachine\Application;

use GetWith\CoffeeMachine\Domain\Drink;

class MakeDrink
{
    public function execute(MakeDrinkRequest $request): string {
        try {  
            $drink = new Drink(
                $request->drink(),
                $request->money(),
                $request->sugar(),
                $request->extraHot(),
            );
            return $drink->order();
        } catch (\InvalidArgumentException $exception) {
            return $exception->getmessage();
        }
    }
}