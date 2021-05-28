<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Controller for the session routes.
 */
class Sessions extends AbstractController
{
    public function index(): Response
    {
        $this->get('session')->set('Test', 'Jonatan');

        return $this->render('session.html.twig');
    }



    public function destroy(): Response
    {
        $this->get('session')->clear();

        return $this->render('session.html.twig');
    }
}
