<?php

declare(strict_types=1);

namespace jope\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use jope\Dice\Game;

use function Mos\Functions\renderView;

/**
 * Controller for the index route.
 */

class DiceController
{
    public function start(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Index page",
            "message" => "Hello, this is the index page, rendered as a layout.",
        ];

        $_SESSION['grapharray'] = array();
        $_SESSION['compgrapharray'] = array();
        $_SESSION['dices'] = 0;
        $callable = new \jope\Dice\Game();
        $callable->playGame();
        $body = renderView("layout/dice.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function play(): void
    {
        $callable = new \jope\Dice\Game();
        $callable->playGame();
    }
}
