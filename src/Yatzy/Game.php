<?php

declare(strict_types=1);

namespace jope\Yatzy;

use function Mos\Functions\{
    destroySession,
    renderView,
    renderTwigView,
    sendResponse,
    url
};
use jope\Yatzy\Dice;
use jope\Yatzy\GraphicalDice;

/**
 * Class Game.
 */

class Game
{
    public function playGame(): void
    {
        $result = array();
        $yatzydata = array();
        $yatzydata['header'] = 'Yatzy';
        $graph = new GraphicalDice();
        $max = 5;
        if (isset($_POST['roll'])) {
            $_SESSION['bonus'] = "";
            $_SESSION['yatzygrapharray'] = array();
            $_SESSION['rolls'] = 0;
            $_SESSION['round'] = 0;
            $_SESSION['sum'] = 0;
            for ($i = 0; $i < $max; $i++) {
                $dice = new Dice();
                $result[$i] = $dice->roll();
                $yatzydata['graphic'] = $graph->graphic($result[$i]);
                array_push($_SESSION['yatzygrapharray'], $yatzydata['graphic']);
            }
        }
        $yatzydata['round'] = $_SESSION['round'] ?? 0;
        $saveArray = array();
        if (isset($_POST['yatzy'])) {
            if ($_SESSION['rolls'] < 3) {
                $_SESSION['rolls'] += 1;
                if (isset($_POST['dices'])) {
                    foreach ($_POST['dices'] as $item) {
                        array_push($saveArray, $_SESSION['yatzygrapharray'][$item]);
                    }
                    $_SESSION['yatzygrapharray'] = array();
                    foreach ($saveArray as $item) {
                        array_push($_SESSION['yatzygrapharray'], $item);
                    }
                } else {
                    $_SESSION['yatzygrapharray'] = array();
                }
                for ($i = 0; $i < $max - count($saveArray); $i++) {
                    $dice = new Dice();
                    $result[$i] = $dice->roll();
                    $yatzydata['graphic'] = $graph->graphic($result[$i]);
                    array_push($_SESSION['yatzygrapharray'], $yatzydata['graphic']);
                }
            }
        }
        $this->nextRound();
        if (isset($_SESSION['round'])) {
            $this->bonus($_SESSION['round'], $_SESSION['sum']);
        }

        /**
         * Checks who wins
         */
        $body = renderView("layout/yatzy.php", $yatzydata);
        sendResponse($body);
    }

    public function nextRound(): void
    {   
        if (isset($_POST['next']) && $_SESSION['round'] <= 6) {
            $result = array();
            $yatzydata = array();
            $yatzydata['header'] = 'Yatzy';
            $graph = new GraphicalDice();
            $max = 5;
            $_SESSION["round"] += 1;
            $str = $graph->graphic($_SESSION['round']);
            $yatzydata['round'] = $_SESSION['round'];
            $tmp = array_count_values($_SESSION['yatzygrapharray']);
            $cnt = $tmp[$str];
            $_SESSION['sum'] += $_SESSION['round'] * $cnt;
            $_SESSION['yatzygrapharray'] = array();
            $_SESSION['rolls'] = 0;
            for ($i = 0; $i < $max; $i++) {
                $dice = new Dice();
                $result[$i] = $dice->roll();
                $yatzydata['graphic'] = $graph->graphic($result[$i]);
                array_push($_SESSION['yatzygrapharray'], $yatzydata['graphic']);
            }
        }
    }
    public function bonus($round, $sum): void
    {   
        if (isset($round)) {
            if ($round == 6 && $sum >= 63) {
                $sum += 50;
                $_SESSION['bonus'] = "Du fick bonusen";
            } elseif ($round == 6 && $sum < 63) {
                $_SESSION['bonus'] = "Du fick ingen bonus";
            }
        }
    }
}
