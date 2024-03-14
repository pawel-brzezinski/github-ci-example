<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Utils\Helpers\ApplicationTrait;
use App\Tests\Utils\Helpers\CLITrait;
use App\Tests\Utils\Helpers\ContainerTrait;
use App\Tests\Utils\Helpers\KernelTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class FunctionalTestCase extends WebTestCase
{
    use Factories;
    use ResetDatabase;

    use ApplicationTrait;
    use CLITrait;
    use ContainerTrait;
    use KernelTrait;

    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();
    }
}
