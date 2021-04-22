<?php

declare(strict_types=1);

namespace Mos\Router;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class RouterTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new Router();
        $controller->dispatch("GET", "/");
        $controller->dispatch("GET", "/session");
        $controller->dispatch("GET", "/debug");
        $controller->dispatch("GET", "/twig");
        $controller->dispatch("GET", "/some/where");
        $controller->dispatch("GET", "/dice");
        $controller->dispatch("POST", "/dice");
        $controller->dispatch("POST", "/fail");
        $this->assertInstanceOf("\Mos\Router\Router", $controller);
    }

}
