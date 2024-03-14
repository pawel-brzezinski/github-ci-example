<?php

namespace App\Tests\Utils\Helpers;

use Symfony\Component\HttpKernel\KernelInterface;

trait KernelTrait
{
    abstract protected static function bootKernel(array $options = []): KernelInterface;

    protected function getKernel(): KernelInterface
    {
        if (false === self::$booted) {
            self::bootKernel();
        }

        return self::$kernel;
    }
}
