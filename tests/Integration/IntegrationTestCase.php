<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Tests\Utils\Helpers\ApplicationTrait;
use App\Tests\Utils\Helpers\CLITrait;
use App\Tests\Utils\Helpers\ContainerTrait;
use App\Tests\Utils\Helpers\KernelTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class IntegrationTestCase extends KernelTestCase
{
    use Factories;
    use ResetDatabase;

    use ApplicationTrait;
    use CLITrait;
    use ContainerTrait;
    use KernelTrait;

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();
    }
}
