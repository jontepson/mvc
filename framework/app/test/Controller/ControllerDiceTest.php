<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class ControllerDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new DiceController();
        $controller->start();
        $this->assertInstanceOf("\App\Controller\DiceController", $controller);
    }

    public function testTheControllerClass()
    {
        $controller = new DiceController();
        $controller->play();
        $this->assertInstanceOf("\App\Controller\DiceController", $controller);
    }
}
