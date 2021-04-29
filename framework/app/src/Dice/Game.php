<?php

declare(strict_types=1);

namespace App\Dice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Dice\Dice;
use App\Dice\DiceHand;
use App\Dice\GraphicalDice;

/**
 * Class Game.
 */
class Game extends AbstractController
{
    
    public function playGame($session): array
    {
        $data = [
            "header" => "Dice"
        ];
        $graph = new GraphicalDice();
        $sum = 0;
        if (isset($_POST['dices'])) {
            $session->set('dices', $_POST['dices']);
            $session->set('sum', 0);
            $session->set('compsum', 0);
            $session->set('grapharray', array());
            $session->set('compgrapharray', array());
            $session->set('message', "Lycka till");
            $grapharray = array();
        }

        $dices = $session->get("dices") ?? 0;

        if (isset($_POST['roll'])) {
            for ($i = 0; $i < $dices; $i++) {
                $dice = new Dice();
                $result[$i] = $dice->roll();
                $sum += $result[$i];
                $data['graphic'] = $graph->graphic($result[$i]);
                $grapharray = $session->get('grapharray');
                array_push($grapharray, $data['graphic']);
                $session->set('grapharray', $grapharray);
            }
            $session->set('sum', $session->get('sum') + $sum);
        }
        $data["userHand"] = $session->get("sum") ?? 0;
        if (isset($_POST['rollcomp'])) {
            while ($session->get("compsum") < $session->get("sum")) {
                $dice2 = new Dice();
                $resultcomp = $dice2->roll();
                $data['graphiccomp'] = $graph->graphic($resultcomp);
                $compgrapharray = $session->get('compgrapharray');
                array_push($compgrapharray, $data['graphiccomp']);
                $session->set('compsum', $session->get('compsum') + $resultcomp);
                $session->set('compgrapharray', $compgrapharray);
            }
            /**
         * Checks who wins
         */
            $this->CheckWinner($session->get('sum'), $session->get('compsum'), $session);
        }

        $data["computerHand"] = $session->get('compsum') ?? 0;
        return $data;
    }

    public function checkWinner($sum, $compSum, $session): void
    {
        if ($sum == 21) {
            $session->set("message", "Grattis");
            $session->set("userWins", $session->get("userWins") + 1);
        } else if ($sum > 21) {
            $session->set("message", "Du är tjock");
            $session->set("compWins", $session->get("compWins") + 1);
        } else if ($sum > $compSum && $sum < 21) {
            $session->set("message", "Grattis du vann");
            $session->set("userWins", $session->get("userWins") + 1);
        } else if ($sum < $compSum && $compSum < 21) {
            $session->set("message", "Datorn vann");
            $session->set("compWins", $session->get("compWins") + 1);
        } else if ($compSum > 21) {
            $session->set("message", "Datorn är tjock");
            $session->set("userWins", $session->get("userWins") + 1);
        } else if ($compSum == $sum) {
            $session->set("message", "Datorn vinner");
            $session->set("compWins", $session->get("compWins") + 1);
        } else if ($compSum == 21) {
            $session->set("message", "Datorn vinner");
            $session->set("compWins", $session->get("compWins") + 1);
        }
    }
}
