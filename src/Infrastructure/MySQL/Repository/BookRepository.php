<?php

declare(strict_types=1);

namespace App\Infrastructure\MySQL\Repository;

use App\Domain\Book\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Shared\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

final class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function get(Uuid $uuid): Book
    {
        $queryBuilder = $this->createQueryBuilder('b');
        $queryBuilder
            ->where('b.id = :id')
            ->setParameter('id', $uuid, UuidType::NAME)
        ;

        if (null === $result = $queryBuilder->getQuery()->getOneOrNullResult()) {
            throw new NotFoundException();
        }

        return $result;
    }

    public function save(Book $book): void
    {
        $this->getEntityManager()->persist($book);
    }

    public function apply(): void
    {
        $this->getEntityManager()->flush();
    }
}
