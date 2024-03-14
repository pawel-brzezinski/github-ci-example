<?php

declare(strict_types=1);

namespace App\Domain\Shared\Exception;

use Exception;

final class NotFoundException extends Exception
{
    private const CODE = 1000;
    private const MESSAGE = 'Resource not found.';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}
