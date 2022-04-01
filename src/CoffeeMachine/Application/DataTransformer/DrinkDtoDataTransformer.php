<?php

namespace GetWith\CoffeeMachine\Application\DataTransformer;

use GetWith\CoffeeMachine\Domain\Drink;

class DrinkDtoDataTransformer implements DrinkDataTransformer
{
    private $drink;

    public function write(Drink $drink)
    {
        $this->drink = $drink;

        return $this;
    }

    public function read()
    {
        return $this->outputOrder();
    }

    private function outputOrder(): string
    {
        $dringTypeMessage = 'You have ordered a ' . $this->drink->name();

        return $dringTypeMessage . $this->extraHotMessage() . $this->amountSugarMessage();
    }

    private function extraHotMessage(): string
    {
        $extraHotMessage = '';
        if ($this->drink->extraHot()) {
            $extraHotMessage = ' extra hot';
        }

        return $extraHotMessage;
    }

    private function amountSugarMessage(): string
    {
        $amountSugarMessage = '';
        if ($this->drink->sugar() > $this->drink->minimunSugar()) {
            $amountSugarMessage = ' with ' . $this->drink->sugar() . ' sugars (stick included)';
        }

        return $amountSugarMessage;
    }
}