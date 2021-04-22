<?php

declare(strict_types=1);

namespace jope\Yatzy;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class GraphicalDiceYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new GraphicalDice();
        $controller->graphic(1);
        $controller->graphic(2);
        $controller->graphic(3);
        $controller->graphic(4);
        $controller->graphic(5);
        $controller->graphic(6);
        $this->assertInstanceOf("\jope\Yatzy\GraphicalDice", $controller);
    }

}