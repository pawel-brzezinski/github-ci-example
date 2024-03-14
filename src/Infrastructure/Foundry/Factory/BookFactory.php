<?php

declare(strict_types=1);

namespace App\Infrastructure\Foundry\Factory;

use App\Domain\Book\Book;
use Symfony\Component\Uid\Uuid;
use Zenstruck\Foundry\ModelFactory;

final class BookFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Book::class;
    }

    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::v4(),
            'title' => self::faker()->sentence(),
            'author' => self::faker()->firstName.' '.self::faker()->lastName,
        ];
    }
}
