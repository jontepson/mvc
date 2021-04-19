<?php

declare(strict_types=1);

namespace jope\Yatzy;

/**
 * Class GraphicalDice.
 */

class GraphicalDice
{
    public function graphic($roll): ?string
    {
        $str = "";
        switch ($roll) {
            case 1:
                $str = "dice1";
                break;
            case 2:
                $str = "dice2";
                break;
            case 3:
                $str = "dice3";
                break;
            case 4:
                $str = "dice4";
                break;
            case 5:
                $str = "dice5";
                break;
            case 6:
                $str = "dice6";
                break;
        }

        return $str;
    }
}
