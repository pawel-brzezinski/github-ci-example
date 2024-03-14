<?php

declare(strict_types=1);

namespace App\Domain\Book\ValueObject;

use Assert\Assertion;

final readonly class Title
{
    private string $title;

    public function __construct(string $title)
    {
        Assertion::notEmpty($title, 'Book title cannot be empty.');

        $this->title = $title;
    }

    public function toString(): string
    {
        return $this->title;
    }
}
