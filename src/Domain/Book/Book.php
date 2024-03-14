<?php

declare(strict_types=1);

namespace App\Domain\Book;

use App\Domain\Book\ValueObject\Author;
use App\Domain\Book\ValueObject\Title;
use App\Infrastructure\MySQL\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(
    repositoryClass: BookRepository::class,
)]
final class Book
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column]
    private string $title;

    #[ORM\Column]
    private string $author;

    private function __construct()
    {
    }

    //
    // Factories
    //

    public static function create(Uuid $id, Title $title, Author $author): self
    {
        $book = new self();
        $book->id = $id;
        $book->title = $title->toString();
        $book->author = $author->toString();

        return $book;
    }

    //
    // Getters
    //

    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }
}
