<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Test cases for the controller Debug.
 */
class GameDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $session = new Session(new MockArraySessionStorage());
        $controller = new Game();
        $controller->playGame($session);
        $this->assertInstanceOf("\App\Dice\Game", $controller);
    
        $_POST['dices'] = 1;
        $_POST['roll'] = 0;
        $_POST['rollcomp'] = true;
        $controller->playGame($session);
        $controller->checkWinner(21, 24, $session);
        $controller->checkWinner(24, 19, $session);
        $controller->checkWinner(19, 16, $session);
        $controller->checkWinner(8, 24, $session);
        $controller->checkWinner(16, 16, $session);
        $controller->checkWinner(17, 21, $session);
        
        $this->assertInstanceOf("\App\Dice\Game", $controller);
        

    }
}
