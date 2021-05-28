<?php

declare(strict_types=1);

namespace App\Highscore;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class HighscoreTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new Highscore();
        $controller->getId();
        $controller->getComputerScore();
        $controller->getUserScore();
        $this->assertInstanceOf("\App\Highscore\Highscore", $controller);
    }
}
