<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\HTTP\Controller\Book\CreateBookController;

use App\Domain\Book\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Tests\Functional\FunctionalTestCase;
use Doctrine\Persistence\ObjectRepository;

final class TemplateRenderingTest extends FunctionalTestCase
{
    private ObjectRepository|BookRepositoryInterface $bookRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = self::getService(BookRepositoryInterface::class);
    }

    public function testItPrintsBookIdInTemplate(): void
    {
        // WHEN
        $this->client->request('GET', '/book/create');

        // THEN
        self::assertResponseStatusCodeSame(200);

        // get saved book
        /** @var Book $actualBook */
        $actualBook = $this->bookRepository->findAll()[0] ?? null;

        self::assertNotNull($actualBook);
        self::assertAnySelectorTextContains('p', (string) $actualBook->getId());
    }
}
