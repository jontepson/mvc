<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class DiceDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new Dice();
        $controller->roll();
        $controller->getLastRoll();
        $this->assertInstanceOf("\App\Dice\Dice", $controller);
    }
}
