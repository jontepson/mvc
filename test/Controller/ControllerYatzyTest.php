<?php

declare(strict_types=1);

namespace jope\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new YatzyController();
        $controller->start();
        $this->assertInstanceOf("\jope\Controller\YatzyController", $controller);
    }

    public function testTheControllerClass()
    {
        $controller = new YatzyController();
        $controller->play();
        $this->assertInstanceOf("\jope\Controller\YatzyController", $controller);
    }
}
