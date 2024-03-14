<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Book;

use App\Domain\Book\Book;
use App\Domain\Book\ValueObject\Author;
use App\Domain\Book\ValueObject\Title;
use App\Tests\Unit\UnitTestCase;
use ReflectionClass;
use Symfony\Component\Uid\Uuid;

final class BookTest extends UnitTestCase
{
    public function testItConstructorIsPrivate(): void
    {
        // GIVEN
        $refClass = new ReflectionClass(Book::class);

        // WHEN
        $actualRefConstructor = $refClass->getConstructor();

        // THEN
        self::assertNotNull($actualRefConstructor);
        self::assertTrue($actualRefConstructor->isPrivate());
    }

    public function testItCreatesNewBook(): void
    {
        // GIVEN
        $id = Uuid::v4();
        $title = new Title('Book title');
        $author = new Author('Book author');

        // WHEN
        $actual = Book::create($id, $title, $author);

        // THEN
        self::assertInstanceOf(Book::class, $actual);
        self::assertSame($id, $actual->getId());
        self::assertSame($title->toString(), $actual->getTitle());
        self::assertSame($author->toString(), $actual->getAuthor());
    }
}
