<?php

declare(strict_types=1);

namespace jope\Dice;


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
                $str = "../view/img/dice1.png";
                break;
            case 2:
                $str = "../view/img/dice2.png";
                break;
            case 3:
                $str = "../view/img/dice3.png";
                break;
            case 4:
                $str = "../view/img/dice4.png";
                break;
            case 5:
                $str = "../view/img/dice5.png";
                break;
            case 6:
                $str = "../view/img/dice6.png";
                break;
        }

        return $str;
    }

    const FACES = 6;
    private ?int $roll = null;

    public function roll(): ?int
    {
        $this->roll = rand(1, self::FACES);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
