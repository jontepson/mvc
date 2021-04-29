<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Session.
 */
class ControllerSessionsTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Sessions();
        $this->assertInstanceOf("\App\Controller\Sessions", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        $controller = new Sessions();

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
        $controller = new Sessions();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
