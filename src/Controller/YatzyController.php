<?php

declare(strict_types=1);

namespace App\Controller;

use App\Yatzy\YatzyGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for the index route.
 */
class YatzyController extends AbstractController
{
    public function start(): Response
    {
        $session = $this->get('session');
        $session->set('dices', 0);
        $session->get('dices');
        $callable = new YatzyGame();

        return $this->render('yatzy.html.twig', $callable->playGame($session));
    }

    public function play(): Response
    {
        $session = $this->get('session');
        $callable = new YatzyGame();

        return $this->render('yatzy.html.twig', $callable->playGame($session));
    }
}
