<?php

declare(strict_types=1);

namespace App\Yatzy;


use App\Yatzy\Dice;
use App\Yatzy\GraphicalDice;
use App\Highscore\HighscoreYatzy;

/**
 * Class Game.
 */

define('__ROOT__', dirname(dirname(__DIR__)));
class yatzyGame
{
    public function playGame($session): array
    {
        $data = [
            "header" => "Yatzy"
        ];

        $result = array();
        $yatzydata = array();
        $graph = new GraphicalDice();
        $max = 5;

        if (isset($_POST['roll'])) {
            $session->set('message', "");
            $session->set('rolls', 0);
            $session->set('bonusMessage', "");
            $session->set('bonus', 0);
            $session->set('sum', 0);
            $session->set('yatzygrapharray', array());
            $graphicArray = array();
            $session->set('basicRoundCounter', 0);
            $session->set('basicSum', 0);
            $session->set('downSum', 0);
            $session->set('ettor', 0);
            $session->set('tvåor', 0);
            $session->set('treor', 0);
            $session->set('fyror', 0);
            $session->set('femmor', 0);
            $session->set('sexor', 0);
            $session->set('par', 0);
            $session->set('2par', 0);
            $session->set('tretal', 0);
            $session->set('fyrtal', 0);
            $session->set('Lstege', 0);
            $session->set('Sstege', 0);
            $session->set('kåk', 0);
            $session->set('chans', 0);
            $session->set('yatzy', 0);
            $session->set('endgame', TRUE);
            for ($i = 0; $i < $max; $i++) {
                $dice = new Dice();
                $result[$i] = $dice->roll();
                $yatzydata['graphic'] = $graph->graphic($result[$i]);
                array_push($graphicArray, $yatzydata['graphic']);
                // var_dump($yatzydata['graphic']);
            }
            $session->set('yatzygrapharray', $graphicArray);
            //var_dump($session->get('yatzygrapharray'));
        }
        $saveArray = array();
        $temparray = array();
        if (isset($_POST['nextRoll'])) {
            if ($session->get('rolls') < 3) {
                $session->set('rolls', $session->get('rolls') + 1);
                if (isset($_POST['dices'])) {
                    $temparray = $session->get('yatzygrapharray');
                    foreach ($_POST['dices'] as $item) {
                        array_push($saveArray, $item);
                    }
                    $session->set('yatzygrapharray', array());
                    $temparray = array();
                    foreach ($saveArray as $item) {
                       array_push($temparray, $item);
                    }
                    $session->set('yatzygrapharray', $temparray);
                } else {
                    $session->set('yatzygrapharray', array());
                }
                for ($i = 0; $i < $max - count($saveArray); $i++) {
                    $dice = new Dice();
                    $result[$i] = $dice->roll();
                    $yatzydata['graphic'] = $graph->graphic($result[$i]);
                    array_push($temparray, $yatzydata['graphic']);
                }
                $session->set('yatzygrapharray', $temparray);
            }
        }
       // $this->nextRound();
        $this->saveBasic($session);
        $this->saveDown($session);
        $this->throw($session);
        $this->bonus($session->get('basicRoundCounter'), $session->get('basicSum'), $session);
        //var_dump($session->get('basicSum'));
        //var_dump($session->get('downSum'));
        $this->gameEnd($session);
        $session->set('sum', $session->get('downSum') + $session->get('basicSum') + $session->get('bonus'));
        $this->saveHighscore($session);
        return $data;
    }

    public function value($string): ?int
    {
        $int = "";
        switch ($string) {
            case "../templates/img/dice1.png":
                $int = 1;
                break;
            case "../templates/img/dice2.png":
                $int = 2;
                break;
            case "../templates/img/dice3.png":
                $int = 3;
                break;
            case "../templates/img/dice4.png":
                $int = 4;
                break;
            case "../templates/img/dice5.png":
                $int = 5;
                break;
            case "../templates/img/dice6.png":
                $int = 6;
                break;
        }

        return $int;
    }
    public function nextRound($session): void
    {   
        $result = array();
        $yatzydata = array();
        $yatzydata['header'] = 'Yatzy';
        $graph = new GraphicalDice();
        $max = 5;
        $session->set('yatzygrapharray', array());
        $session->set('rolls', 0);
        $graphicArray = array();
        for ($i = 0; $i < $max; $i++) {
            $dice = new Dice();
            $result[$i] = $dice->roll();
            $yatzydata['graphic'] = $graph->graphic($result[$i]);
            array_push($graphicArray, $yatzydata['graphic']);
        }
        $session->set('yatzygrapharray', $graphicArray);
    }

    public function bonus($round, $sum, $session): void
    {   
        if (isset($round)) {
            if ($round == 6 && $sum >= 63) {
                $sum += 50;
                $session->set('bonus', 50);
                $session->set('round', $session->get('round') + 1);
                $session->set('bonusMessage', "Du fick bonusen");
            } elseif ($round == 6 && $sum < 63) {
                $session->set('bonusMessage', "Du fick ingen bonus");
            }
        }
    }

    public function saveBasic($session): void
    {
        $count = 0;
        $score = 0;
        $array = array();
        if (isset($_POST['ettor'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice1.png'));
            $score = $count;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('ettor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['tvåor'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice2.png'));
            $score = $count * 2;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('tvåor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['treor'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice3.png'));
            $score = $count * 3;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('treor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['fyror'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice4.png'));
            $score = $count * 4;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('fyror', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['femmor'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice5.png'));
            $score = $count * 5;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('femmor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['sexor'])) {
            $array = $session->get('yatzygrapharray');
            $count = count(array_keys($array, '../templates/img/dice6.png'));
            $score = $count * 6;
            $session->set('basicSum', $session->get('basicSum') + $score);
            $session->set('sexor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }
    }

    public function throw($session): void
    {
        if (isset($_POST['ettorThrow'])) {
            $session->set('ettor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['tvåorThrow'])) {
            $session->set('tvåor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['treorThrow'])) {
            $session->set('treor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['fyrorThrow'])) {
            $session->set('fyror', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['femmorThrow'])) {
            $session->set('femmor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['sexorThrow'])) {
            $session->set('sexor', 1);
            $session->set('basicRoundCounter', $session->get('basicRoundCounter') + 1);
            $this->nextRound($session);
        }

        if (isset($_POST['parThrow'])) {
            $session->set('par', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['2parThrow'])) {
            $session->set('2par', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['tretalThrow'])) {
            $session->set('tretal', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['fyrtalThrow'])) {
            $session->set('fyrtal', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['LstegeThrow'])) {
            $session->set('Lstege', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['SstegeThrow'])) {
            $session->set('Sstege', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['kåkThrow'])) {
            $session->set('kåk', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['chansThrow'])) {
            $session->set('chans', 1);
            $this->nextRound($session);
        }

        if (isset($_POST['yatzyThrow'])) {
            $session->set('yatzy', 1);
            $this->nextRound($session);
        }
    }

    public function saveDown($session): void
    {
        if (isset($_POST['par'])) {
            $pairArray = array();
            $array = $session->get('yatzygrapharray');
            $countArray = array_count_values($array);
            $arrayChunks = array_chunk($countArray, 1, TRUE);
            foreach ($arrayChunks as $key => $value) {
                foreach ($value as $secondkey => $secondvalue) {
                    if ($secondvalue == 2) {
                        array_push($pairArray, $secondkey);
                    } elseif ($secondvalue == 3) {
                        array_push($pairArray, $secondkey);
                    } elseif ($secondvalue == 4) {
                        array_push($pairArray, $secondkey);
                    }
                }
            }
            if (sizeof($pairArray) == 2) {
                
                $score1 = $this->value($pairArray[0]);
                $score2 = $this->value($pairArray[1]);

                if ($score1 > $score2) {
                    $score = $score1 * 2;
                    $session->set('downSum', $session->get('downSum') + $score);
                } elseif ($score2 > $score1) {
                    $score = $score2 * 2;
                    $session->set('downSum', $session->get('downSum') + $score);
                }
                $session->set('par', 1);
                $session->set('message', '');
                $this->nextRound($session);
            } elseif(sizeof($pairArray) == 1) {
                $score = $this->value($pairArray[0]) * 2;
                $session->set('downSum', $session->get('downSum') + $score);
                $session->set('par', 1);
                $session->set('message', '');
                $this->nextRound($session);
            } else {
                $session->set('message', 'Du har inget 1 par');
            }
        }

        if (isset($_POST['2par'])) {
            $pairArray = array();
            $array = $session->get('yatzygrapharray');
            $countArray = array_count_values($array);
            $arrayChunks = array_chunk($countArray, 1, TRUE);
            foreach ($arrayChunks as $key => $value) {
                foreach ($value as $secondkey => $secondvalue) {
                    if ($secondvalue == 2) {
                        array_push($pairArray, $secondkey);
                    } elseif ($secondvalue == 3) {
                        array_push($pairArray, $secondkey);
                    } elseif ($secondvalue == 4) {
                        array_push($pairArray, $secondkey);
                        array_push($pairArray, $secondkey);
                    }
                }
            }
            if (sizeof($pairArray) == 2) {
                foreach ($pairArray as $dice) {
                    $diceValue = $this->value($dice);
                    $score = $diceValue * 2;
                    $session->set('downSum', $session->get('downSum') + $score);
                }
                $session->set('2par', 1);
                $session->set('message', '');
                $this->nextRound($session);
            } else {
                $session->set('message', 'Du har inget 2 par');
            }
        }

        if (isset($_POST['tretal'])) {
            $array = $session->get('yatzygrapharray');
            $countArray = array_count_values($array);
            foreach ($countArray as $key => $value) {
                if ($value == 3) {
                    $diceValue = $this->value($key);
                    $score = $diceValue * 3;
                    $session->set('downSum', $session->get('downSum') + $score);
                    $session->set('tretal', 1);
                    $session->set('message', '');
                    $this->nextRound($session);
                    return;
                } else {
                    $session->set('message', 'Du har inte tretal');
                }
            }
        }

        if (isset($_POST['fyrtal'])) {
            $array = $session->get('yatzygrapharray');
            $countArray = array_count_values($array);
            foreach ($countArray as $key => $value) {
                if ($value == 4) {
                    $diceValue = $this->value($key);
                    $score = $diceValue * 4;
                    $session->set('downSum', $session->get('downSum') + $score);
                    $session->set('fyrtal', 1);
                    $session->set('message', '');
                    $this->nextRound($session);
                    return;
                } else {
                    $session->set('message', 'Du har inte fyrtal');
                }
            }
        }

        if (isset($_POST['Lstege'])) {
            $array = $session->get('yatzygrapharray');
            if (in_array('../templates/img/dice1.png', $array) && in_array('../templates/img/dice2.png', $array) && in_array('../templates/img/dice3.png', $array) && in_array('../templates/img/dice4.png', $array) && in_array('../templates/img/dice5.png', $array)) {
                $score = 15;
                $session->set('downSum', $session->get('downSum') + $score);
                $session->set('Lstege', 1);
                $this->nextRound($session);
            } else {
                $session->set('message', 'Du har ingen stege');
            }
        }

        if (isset($_POST['Sstege'])) {
            $array = $session->get('yatzygrapharray');
            if (in_array('../templates/img/dice6.png', $array) && in_array('../templates/img/dice2.png', $array) && in_array('../templates/img/dice3.png', $array) && in_array('../templates/img/dice4.png', $array) && in_array('../templates/img/dice5.png', $array)) {
                $score = 20;
                $session->set('downSum', $session->get('downSum') + $score);
                $session->set('Sstege', 1);
                $this->nextRound($session);
            } else {
                $session->set('message', 'Du har ingen stege');
            }
        }

        if (isset($_POST['kåk'])) {
            $array = $session->get('yatzygrapharray');
            $countArray = array_count_values($array);
            if (array_values($countArray)[0] == 2 && array_values($countArray)[1] == 3) {
                $diceValue1 = $this->value(array_keys($countArray)[0]);
                $diceValue2 = $this->value(array_keys($countArray)[1]);
                $score1 = $diceValue1 * 2;
                $score2 = $diceValue2 * 3;
                $session->set('downSum', $session->get('downSum') + $score1 + $score2);
                $session->set('kåk', 1);
                $session->set('message', '');
                $this->nextRound($session);
                return;
            } elseif (array_values($countArray)[1] == 2 && array_values($countArray)[0] == 3){
                $diceValue1 = $this->value(array_keys($countArray)[1]);
                $diceValue2 = $this->value(array_keys($countArray)[0]);
                $score1 = $diceValue1 * 2;
                $score2 = $diceValue2 * 3;
                $session->set('downSum', $session->get('downSum') + $score1 + $score2);
                $session->set('kåk', 1);
                $session->set('message', '');
                $this->nextRound($session);
                return;
            } else {
                 $session->set('message', 'Du har inte kåk');
            }
        }

        if (isset($_POST['chans'])) {
            $array = $session->get('yatzygrapharray');
            //var_dump($array);
            foreach ($array as $key => $value) {
                $score = $this->value($value);
                $session->set('downSum', $session->get('downSum') + $score);
                $session->set('message', '');
            }
            $session->set('chans', 1);
            $this->nextRound($session);
            

        }


        if (isset($_POST['yatzy'])) {
            $array = $session->get('yatzygrapharray');
            $count = array_count_values($array);
            $count = reset($count);
            if ($count == 5) {
                $score = 50;
                $session->set('downSum', $session->get('downSum') + $score);
                $session->set('yatzy', 1);
                $this->nextRound($session);
            } else {
                $session->set('message', 'Du har inte yatzy');
            }
        }
    }

    public function gameEnd($session): void
    {
        $endGame = TRUE;
        $session->set('endgame', TRUE);
        if ($boxCounter = $session->get('ettor') == 1 && $session->get('tvåor') == 1 && $session->get('treor') == 1 && $session->get('fyror') == 1 && $session->get('femmor') == 1 && $session->get('sexor') == 1 && $session->get('par') == 1 && $session->get('2par') == 1 && $session->get('tretal') == 1 && $session->get('fyrtal') == 1 && $session->get('Lstege') == 1 && $session->get('Sstege') == 1 && $session->get('kåk') == 1 && $session->get('chans') == 1&& $session->get('yatzy') == 1) {
            $session->set('endgame', FALSE);
            //var_dump('endgame');
        }
    }

    public function saveHighscore($session): void
    {
        if (isset($_POST['save'])) {
            $yatzyHighscore = new HighscoreYatzy();
            if ($_POST['namn'] != "") {
                $yatzyHighscore->setName($_POST['namn']);
            } else {
                $yatzyHighscore->setName("Anonym");
            }

            require_once __ROOT__ .  "/bin/bootstrap.php";

            $yatzyHighscore->setScore($session->get('sum'));
            $yatzyHighscore->setlowerScore($session->get('basicSum'));
            $yatzyHighscore->setupperScore($session->get('downSum'));
            $yatzyHighscore->setBonus($session->get('bonus'));

            $entityManager->persist($yatzyHighscore);
            $entityManager->flush();
        }
    }
}
