<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Test cases for the controller Debug.
 */
class ControllerHelloWorldTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new HelloWorldController();
        $controller->helloMessage();
        $controller->helloMessageView();
        $controller->hello();
        $controller->helloWithArgument("hello");
        $this->assertInstanceOf("\App\Controller\HelloWorldController", $controller);
    }
}
