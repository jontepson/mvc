<?php

declare(strict_types=1);

namespace App\Book;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class BookTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new Book();
        $controller->getId();
        $controller->getName();
        $controller->setName('test');
        $controller->setISBN(2);
        $controller->getISBN();
        $controller->getWriter();
        $controller->setWriter('test');
        $controller->getImage();
        $controller->setImage('test');
        $this->assertInstanceOf("\App\Book\Book", $controller);
    }
}
