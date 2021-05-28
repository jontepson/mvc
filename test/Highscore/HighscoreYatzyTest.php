<?php

declare(strict_types=1);

namespace App\Highscore;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class HighscoreYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new HighscoreYatzy();
        $controller->getId();
        $controller->setScore(2);
        $controller->getScore();
        $controller->getBonus();
        $controller->setBonus(10);
        $controller->getlowerScore();
        $controller->setlowerScore(10);
        $controller->getupperScore();
        $controller->setupperScore(10);
        $controller->getName();
        $controller->setName('test');
        $this->assertInstanceOf("\App\Highscore\HighscoreYatzy", $controller);
    }
}
