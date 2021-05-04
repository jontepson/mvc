<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * Controller for the index route.
 */

class BookController extends AbstractController
{
    public function getBooks(): Response
    {   
        require_once  "../bin/bootstrap.php";

        $bookRepository = $entityManager->getRepository('\App\Book\Book');
        $books = $bookRepository->findAll();
       
   
        return $this->render('books.html.twig', [
            "books" => $books
            ]);
    }

}