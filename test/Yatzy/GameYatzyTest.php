<?php

declare(strict_types=1);

namespace App\Yatzy;

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
        $session->set('dices', 0);
        $session->get('dices');
        $controller = new YatzyGame();

        $controller->playGame($session);
        $controller->value("../templates/img/dice1.png");
        $controller->value("../templates/img/dice2.png");
        $controller->value("../templates/img/dice3.png");
        $controller->value("../templates/img/dice4.png");
        $controller->value("../templates/img/dice5.png");
        $controller->value("../templates/img/dice6.png");
        $controller->nextRound($session);
        $controller->bonus(6, 64, $session);
        $controller->bonus(6, 55, $session);

        // Spara överdel
        $_POST['ettor'] = true;
        $controller->saveBasic($session);
        $_POST['tvåor'] = true;
        $controller->saveBasic($session);
        $_POST['treor'] = true;
        $controller->saveBasic($session);
        $_POST['fyror'] = true;
        $controller->saveBasic($session);
        $_POST['femmor'] = true;
        $controller->saveBasic($session);
        $_POST['sexor'] = true;
        $controller->saveBasic($session);

        // Kasta
        $_POST['ettorThrow'] = true;
        $controller->throw($session);
        $_POST['tvåorThrow'] = true;
        $controller->throw($session);
        $_POST['treorThrow'] = true;
        $controller->throw($session);
        $_POST['fyrorThrow'] = true;
        $controller->throw($session);
        $_POST['femmorThrow'] = true;
        $controller->throw($session);
        $_POST['sexorThrow'] = true;
        $controller->throw($session);
        $_POST['parThrow'] = true;
        $controller->throw($session);
        $_POST['2parThrow'] = true;
        $controller->throw($session);
        $_POST['tretalThrow'] = true;
        $controller->throw($session);
        $_POST['fyrtalThrow'] = true;
        $controller->throw($session);
        $_POST['LstegeThrow'] = true;
        $controller->throw($session);
        $_POST['SstegeThrow'] = true;
        $controller->throw($session);
        $_POST['kåkThrow'] = true;
        $controller->throw($session);
        $_POST['chansThrow'] = true;
        $controller->throw($session);
        $_POST['yatzyThrow'] = true;
        $controller->throw($session);

        // Spara nederdel
        $_POST['par'] = true;
        $controller->saveDown($session);
        $_POST['2par'] = true;
        $controller->saveDown($session);
        $_POST['tretal'] = true;
        $controller->saveDown($session);
        $_POST['fyrtal'] = true;
        $controller->saveDown($session);
        $_POST['Lstege'] = true;
        $controller->saveDown($session);
        $_POST['Sstege'] = true;
        $controller->saveDown($session);
        $_POST['kåk'] = true;
        $controller->saveDown($session);
        $_POST['chans'] = true;
        $controller->saveDown($session);
        $_POST['yatzy'] = true;
        $controller->saveDown($session);
        $this->assertInstanceOf("\App\Yatzy\YatzyGame", $controller);
    }
}
