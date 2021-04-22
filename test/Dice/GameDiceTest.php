<?php

declare(strict_types=1);

namespace jope\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

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
        $controller = new Game();
        $_POST['dices'] = 1;
        $_POST['roll'] = 0;
        $_POST['rollcomp'] = true;
        $_SESSION['compWins'] = 0;
        $_SESSION['userWins'] = 0;
        $controller->playGame();
        $this->assertInstanceOf("\jope\Dice\Game", $controller);
    }
}
