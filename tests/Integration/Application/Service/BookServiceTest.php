<?php

declare(strict_types=1);

namespace App\Tests\Integration\Application\Service;

use App\Application\Service\BookService;
use App\Domain\Book\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Shared\Exception\NotFoundException;
use App\Tests\Integration\IntegrationTestCase;

final class BookServiceTest extends IntegrationTestCase
{
    private BookRepositoryInterface $bookRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = self::getService(BookRepositoryInterface::class);
    }

    public function testItCreatesBook(): void
    {
        // GIVEN
        $title = 'Lorem Ipsum';
        $author = 'John Doe';

        // WHEN
        $actual = $this->serviceUnderTest()->createBook($title, $author);

        // THEN
        self::assertInstanceOf(Book::class, $actual);

        // Be sure that book was stored in the database
        try {
            $actualEntity = $this->bookRepository->get($actual->getId());
        } catch (NotFoundException) {
            self::fail('The book was not saved in the database');
        }
    }

    private function serviceUnderTest(): BookService
    {
        return self::getService(BookService::class);
    }
}
