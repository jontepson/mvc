<?php

require_once __DIR__ . "/bootstrap.php";

$bookRepository = $entityManager->getRepository('\App\Book\Book');
$books = $bookRepository->findAll();

echo "All Books\n--------------------\n";

if ($books) {
    foreach ($books as $book) {
        echo sprintf("%2d - %s (%d) - %s\n",
            $book->getId(),
            $book->getName(),
            $book->getISBN(),
            $book->getWriter(),
            $book->getImage()
        );
    }
} else {
    echo " (empty)\n";
}
