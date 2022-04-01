#!/usr/bin/env php
<?php // application.php

require __DIR__ . '/vendor/autoload.php';

use GetWith\CoffeeMachine\Console\BaseCommand;
use Symfony\Component\Console\Application;
use GetWith\CoffeeMachine\Infrastructure\DrinkOrder;

$application = new Application();

$application->add(new BaseCommand(new DrinkOrder()));

$application->run();
