#!/usr/bin/env php
<?php // application.php

require __DIR__ . '/vendor/autoload.php';

use GetWith\CoffeeMachine\Console\MakeDrinkCommand;
use Symfony\Component\Console\Application;
use GetWith\CoffeeMachine\Infrastructure\DrinkOrder;

$application = new Application();

$application->add(new MakeDrinkCommand(new DrinkOrder()));

$application->run();
