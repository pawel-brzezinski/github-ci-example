<?php

declare(strict_types=1);

namespace App\UI\HTTP\Controller\Book;

use App\Application\Service\BookService;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateBookController extends AbstractController
{
    #[Route(
        path: '/book/create',
        name: 'book_create',
        methods: ['GET'],
    )]
    public function __invoke(BookService $service): Response
    {
        //
        // In normal app, the book should be created by POST request by form or API request.
        //
        $faker = Factory::create();

        $title = $faker->sentence();
        $author = $faker->firstName().' '.$faker->lastName();

        $book = $service->createBook($title, $author);

        return $this->render('book/create.html.twig', [
            'book' => $book,
        ]);
    }
}
