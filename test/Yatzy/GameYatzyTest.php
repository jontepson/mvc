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
        $controller = new yatzyGame();

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
        $_POST['ettor'] = TRUE;
        $controller->saveBasic($session);
        $_POST['tvåor'] = TRUE;
        $controller->saveBasic($session);
        $_POST['treor'] = TRUE;
        $controller->saveBasic($session);
        $_POST['fyror'] = TRUE;
        $controller->saveBasic($session);
        $_POST['femmor'] = TRUE;
        $controller->saveBasic($session);
        $_POST['sexor'] = TRUE;
        $controller->saveBasic($session);

        // Kasta 
        $_POST['ettorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['tvåorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['treorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['fyrorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['femmorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['sexorThrow'] = TRUE;
        $controller->throw($session);
        $_POST['parThrow'] = TRUE;
        $controller->throw($session);
        $_POST['2parThrow'] = TRUE;
        $controller->throw($session);
        $_POST['tretalThrow'] = TRUE;
        $controller->throw($session);
        $_POST['fyrtalThrow'] = TRUE;
        $controller->throw($session);
        $_POST['LstegeThrow'] = TRUE;
        $controller->throw($session);
        $_POST['SstegeThrow'] = TRUE;
        $controller->throw($session);
        $_POST['kåkThrow'] = TRUE;
        $controller->throw($session);
        $_POST['chansThrow'] = TRUE;
        $controller->throw($session);
        $_POST['yatzyThrow'] = TRUE;
        $controller->throw($session);

        // Spara nederdel
        $_POST['par'] = TRUE;
        $controller->saveDown($session);
        $_POST['2par'] = TRUE;
        $controller->saveDown($session);
        $_POST['tretal'] = TRUE;
        $controller->saveDown($session);
        $_POST['fyrtal'] = TRUE;
        $controller->saveDown($session);
        $_POST['Lstege'] = TRUE;
        $controller->saveDown($session);
        $_POST['Sstege'] = TRUE;
        $controller->saveDown($session);
        $_POST['kåk'] = TRUE;
        $controller->saveDown($session);
        $_POST['chans'] = TRUE;
        $controller->saveDown($session);
        $_POST['yatzy'] = TRUE;
        $controller->saveDown($session);
        $this->assertInstanceOf("\App\Yatzy\yatzyGame", $controller);
    }
}
