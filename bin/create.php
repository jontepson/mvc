<?php

use App\Book\Book;

require_once __DIR__ . "/bootstrap.php";

if ($argc !== 5) {
    echo "Usage ${argv[0]} <name> <value>\n";
    exit(1);
}

$newBookName = $argv[1];
$newBookISBN = $argv[2];
$newBookWriter = $argv[3];
$newBookImage = $argv[4];

$book = new Book();
$book->setName($newBookName);
$book->setISBN($newBookISBN);
$book->setWriter($newBookWriter);
$book->setImage($newBookImage);

$entityManager->persist($book);
$entityManager->flush();

echo "Created Book with ID " . $book->getId() . "\n";
