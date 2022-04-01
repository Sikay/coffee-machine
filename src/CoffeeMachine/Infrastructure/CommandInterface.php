<?php

namespace GetWith\CoffeeMachine\Infrastructure;

use Symfony\Component\Console\Input\InputInterface;

interface CommandInterface
{
    public function command(): string;
    public function configure(): array;
    public function execute(InputInterface $input): string;
}