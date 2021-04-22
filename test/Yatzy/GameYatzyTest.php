<?php

declare(strict_types=1);

namespace jope\Yatzy;

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
        $_POST['roll'] = true;
        $_POST['yatzy'] = true;
        $_POST['dices'] = [1, 2];
        $_POST['next'] = true;
        $tmp['dice1'] = 0;
        $controller->playGame();
        $controller->bonus(6, 63);
        $controller->bonus(6, 50);
        $this->assertInstanceOf("\jope\Yatzy\Game", $controller);
    }
}
