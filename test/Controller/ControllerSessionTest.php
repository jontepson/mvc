<?php

declare(strict_types=1);

namespace jope\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerSessionTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Session();
        $this->assertInstanceOf("\jope\Controller\Session", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        $controller = new Session();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }



    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        $controller = new Session();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
