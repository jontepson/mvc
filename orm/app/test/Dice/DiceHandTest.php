<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class DiceHandTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheClass()
    {
        $controller = new DiceHand();
        $controller->roll();
        $controller->getLastRoll();
        $controller->getSum();
        $this->assertInstanceOf("\App\Dice\DiceHand", $controller);
    }

}
