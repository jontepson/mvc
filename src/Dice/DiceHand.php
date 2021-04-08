<?php

declare(strict_types=1);

namespace jope\Dice;

use jope\Dice\GraphicalDice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private ?array $dices;
    private ?int $sum;
    public function __construct()
    {
        for ($i = 0; $i < 2; $i++) {
            $this->dices[$i] = new Dice();
        }
        $this->sum = 0;
    }

    public function roll(): void
    {
        $this->sum = 0;
        for ($i = 0; $i < 2; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): string
    {
        $res = "";
        $graph = new GraphicalDice();
        for ($i = 0; $i < 2; $i++) {
            $res .= $graph->graphic($this->dices[$i]->getLastRoll()) . ", ";
        }
        return $res . " = " . $this->sum;
    }

    public function getSum(): int
    {
        return $this->sum;
    }
}
