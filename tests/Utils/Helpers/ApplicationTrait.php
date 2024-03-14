<?php

namespace App\Tests\Utils\Helpers;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;

trait ApplicationTrait
{
    private ?Application $application = null;

    abstract protected function getKernel(): KernelInterface;

    protected function getApplication(): Application
    {
        if (null === $this->application) {
            $this->application = new Application($this->getKernel());
        }

        return $this->application;
    }
}
