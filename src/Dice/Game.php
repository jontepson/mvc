<?php

declare(strict_types=1);

namespace jope\Dice;

use function jope\Functions\{
    destroySession,
    redirectTo,
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

        $dices = $_SESSION["dices"];
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
        $data["userHand"] = $_SESSION["sum"];

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
            if ($_SESSION["sum"] == 21) {
                $data["message"] = "Grattis";
                $_SESSION["userWins"] += 1;
            } else if ($_SESSION["sum"] > 21) {
                $data["message"] = "Du är tjock";
                $_SESSION["compWins"] += 1;
            } else if ($_SESSION["sum"] > $_SESSION["compsum"] && $_SESSION["sum"] < 21) {
                $data["message"] = "Grattis du vann";
                $_SESSION["userWins"] += 1;
            } else if ($_SESSION["sum"] < $_SESSION["compsum"] && $_SESSION["compsum"] < 21) {
                $data["message"] = "Datorn vann";
                $_SESSION["compWins"] += 1;
            } else if ($_SESSION["compsum"] > 21) {
                $data["message"] = "Datorn är tjock";
                $_SESSION["userWins"] += 1;
            } else if ($_SESSION["compsum"] == $_SESSION['sum']) {
                $data["message"] = "Datorn vinner";
                $_SESSION["compWins"] += 1;
            } else if ($_SESSION["compsum"] == 21) {
                $data["message"] = "Datorn vinner";
                $_SESSION["compWins"] += 1;
            }
        }
        $data["computerHand"] = $_SESSION["compsum"];
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
