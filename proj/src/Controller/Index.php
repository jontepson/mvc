<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * Controller for the index route.
 */

class Index extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('index.html.twig', [
            "header" => "Index page",
            "message" => "Hello, this is the index page, rendered as a layout."
        ]);
        
        
    }
}
