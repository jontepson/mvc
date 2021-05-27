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
     * @group 
     */
    public function testCreateTheClass()
    {
        $session = new Session(new MockArraySessionStorage());
        /*
        $session->set('dices', 0);
        $session->get('dices'); */
        $controller = new Game();
        /*
        $_POST['dices'] = 1;
        $_POST['roll'] = 0;
        $_POST['rollcomp'] = true;
        $controller->playGame($session);
        $controller->checkWinner(21, 24, $session);
        $controller->checkWinner(13, 24, $session);
        $controller->checkWinner(19, 17, $session);
        $controller->checkWinner(22, 20, $session);
        $controller->checkWinner(13, 17, $session);
        $controller->checkWinner(17, 17, $session);
        $controller->checkWinner(13, 21, $session); */
        $this->assertInstanceOf("\App\Dice\Game", $controller);
    }
}
