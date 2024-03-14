<?php

declare(strict_types=1);

namespace App\Infrastructure\MySQL\Repository;

use App\Domain\Book\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Shared\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * @template-extends  ServiceEntityRepository<Book>
 */
final class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        /** @var class-string<Book> $entityName */
        $entityName = Book::class;

        parent::__construct($registry, $entityName);
    }

    /**
     * @throws Exception
     * @throws NotFoundException
     */
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

        if (!$result instanceof Book) {
            throw new Exception('The result should be an object');
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
