<?php

declare(strict_types=1);

namespace App\Dice;

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
                $str = "../templates/img/dice1.png";
                break;
            case 2:
                $str = "../templates/img/dice2.png";
                break;
            case 3:
                $str = "../templates/img/dice3.png";
                break;
            case 4:
                $str = "../templates/img/dice4.png";
                break;
            case 5:
                $str = "../templates/img/dice5.png";
                break;
            case 6:
                $str = "../templates/img/dice6.png";
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
