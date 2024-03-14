<?php

namespace App\Tests\Utils\Helpers;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LazyCommand;

trait CLITrait
{
    abstract protected function getApplication(): Application;

    protected function getCommand(string $commandName): Command
    {
        $command = $this->getApplication()->get($commandName);

        if ($command instanceof LazyCommand) {
            $command = $command->getCommand();
        }

        return $command;
    }
}
