<?php

declare(strict_types=1);

namespace jope\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use jope\Yatzy\Game;

use function Mos\Functions\renderView;

/**
 * Controller for the index route.
 */

class YatzyController
{
    public function start(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Index page",
            "message" => "Hello, this is the index page, rendered as a layout.",
        ];
        $_SESSION['yatzygrapharray'] = array();
        $callable = new Game();
        $callable->playGame();
        $body = renderView("layout/yatzy.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();
        $callable = new Game();
        $data = [
            "header" => "Yatzy"
        ];
        $callable->playGame();
        $body = renderView("layout/yatzy.php", $data);
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
