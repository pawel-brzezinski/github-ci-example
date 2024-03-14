<?php

declare(strict_types=1);

namespace App\Domain\Book\ValueObject;

use Assert\Assertion;

final readonly class Author
{
    private string $author;

    public function __construct(string $author)
    {
        Assertion::notEmpty($author, 'Book author cannot be empty.');

        $this->author = $author;
    }

    public function toString(): string
    {
        return $this->author;
    }
}
