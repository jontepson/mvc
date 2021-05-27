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

class HighscoreController extends AbstractController
{
    public function getHighscores(): Response
    {   
        require_once  "../bin/bootstrap.php";

        $highscoreRepository = $entityManager->getRepository('\App\Highscore\Highscore');
        $highscores = $highscoreRepository->findAll();

        $yatzyhighscoreRepository = $entityManager->getRepository('\App\Highscore\HighscoreYatzy');
        $yatzyhighscores = $yatzyhighscoreRepository->findAll();
   
        return $this->render('highscore.html.twig', [
            "scores" => $highscores,
            "yatzyScores" => $yatzyhighscores
            ]);
    }

}
