<?php

namespace GetWith\CoffeeMachine\Domain;

interface Drinkeable
{
    public function name(): string;
    
    public function price(): float;
}