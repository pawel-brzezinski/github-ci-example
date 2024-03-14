<?php

namespace App\Domain\Book\Repository;

use App\Domain\Book\Book;
use App\Domain\Shared\Exception\NotFoundException;
use Symfony\Component\Uid\Uuid;

interface BookRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function get(Uuid $uuid): Book;

    public function save(Book $book): void;

    public function apply(): void;
}
