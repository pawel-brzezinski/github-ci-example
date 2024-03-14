<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Book\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Book\ValueObject\Author;
use App\Domain\Book\ValueObject\Title;
use Symfony\Component\Uid\UuidV4;

final readonly class BookService
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    public function createBook(string $title, string $author): Book
    {
        $book = Book::create(UuidV4::v4(), new Title($title), new Author($author));

        $this->bookRepository->save($book);
        $this->bookRepository->apply();

        return $book;
    }
}
