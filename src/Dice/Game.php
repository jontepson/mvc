<?php

declare(strict_types=1);

namespace jope\Dice;

use function Mos\Functions\{
    destroySession,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

use jope\Dice\Dice;
use jope\Dice\DiceHand;
use jope\Dice\GraphicalDice;

/**
 * Class Game.
 */
class Game
{
    public function playGame(): void
    {
        $data = [
            "header" => "Dice"
        ];
        $graph = new GraphicalDice();
        $sum = 0;
        if (isset($_POST['dices'])) {
            $_SESSION["dices"] = $_POST['dices'];
            $_SESSION["sum"] = 0;
            $_SESSION["compsum"] = 0;
            $_SESSION['grapharray'] = array();
            $_SESSION['compgrapharray'] = array();
        }

        $dices = $_SESSION["dices"] ?? 0;
        $diceHand = new DiceHand();
        $diceHand->roll();

        if (isset($_POST['roll'])) {
            for ($i = 0; $i < $dices; $i++) {
                $dice = new Dice();
                $result[$i] = $dice->roll();
                $sum += $result[$i];
                $data['graphic'] = $graph->graphic($result[$i]);
                array_push($_SESSION['grapharray'], $data['graphic']);
            }
            $_SESSION["sum"] += $sum;
        }
        $data["userHand"] = $_SESSION["sum"] ?? 0;

        if (isset($_POST['rollcomp'])) {
            while ($_SESSION["compsum"] < $_SESSION["sum"]) {
                $dice2 = new Dice();
                $resultcomp = $dice2->roll();
                $data['graphiccomp'] = $graph->graphic($resultcomp);
                array_push($_SESSION['compgrapharray'], $data['graphiccomp']);
                $_SESSION["compsum"] += $resultcomp;
            }
            /**
         * Checks who wins
         */
            $this->CheckWinner($_SESSION['sum'], $_SESSION['compsum']);
        }
        $data["computerHand"] = $_SESSION["compsum"] ?? 0;
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function checkWinner($sum, $compSum): void
    {
        if ($sum == 21) {
            $_SESSION["message"] = "Grattis";
            $_SESSION["userWins"] += 1;
        } else if ($sum > 21) {
            $_SESSION["message"] = "Du är tjock";
            $_SESSION["compWins"] += 1;
        } else if ($sum > $compSum && $sum < 21) {
            $_SESSION["message"] = "Grattis du vann";
            $_SESSION["userWins"] += 1;
        } else if ($sum < $compSum && $compSum < 21) {
            $_SESSION["message"] = "Datorn vann";
            $_SESSION["compWins"] += 1;
        } else if ($compSum > 21) {
            $_SESSION["message"] = "Datorn är tjock";
            $_SESSION["userWins"] += 1;
        } else if ($compSum == $_SESSION['sum']) {
            $_SESSION["message"] = "Datorn vinner";
            $_SESSION["compWins"] += 1;
        } else if ($compSum == 21) {
            $_SESSION["message"] = "Datorn vinner";
            $_SESSION["compWins"] += 1;
        }
    }
}