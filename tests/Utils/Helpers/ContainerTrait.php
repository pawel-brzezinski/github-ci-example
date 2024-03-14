<?php

namespace App\Tests\Utils\Helpers;

use Symfony\Component\DependencyInjection\ContainerInterface;

trait ContainerTrait
{
    abstract protected static function getContainer(): ContainerInterface;

    protected function getService(string $serviceId): ?object
    {
        return self::getContainer()->get($serviceId);
    }

    protected function setService(string $serviceId, object $service): void
    {
        self::getContainer()->set($serviceId, $service);
    }
}
