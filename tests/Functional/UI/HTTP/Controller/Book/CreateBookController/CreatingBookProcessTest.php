<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\HTTP\Controller\Book\CreateBookController;

use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Tests\Functional\FunctionalTestCase;
use Doctrine\Persistence\ObjectRepository;

final class CreatingBookProcessTest extends FunctionalTestCase
{
    private ObjectRepository|BookRepositoryInterface $bookRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = self::getService(BookRepositoryInterface::class);
    }

    public function testItSavesBookInDatabase(): void
    {
        // GIVEN

        // pre-assertion - be sure that database is empty
        self::assertEmpty($this->bookRepository->findAll());

        // WHEN
        $this->client->request('GET', '/book/create');

        // THEN
        self::assertResponseStatusCodeSame(200);

        // be sure that database has one new record
        self::assertCount(1, $this->bookRepository->findAll());
    }
}
