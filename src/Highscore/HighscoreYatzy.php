<?php

namespace App\Highscore;

class HighscoreYatzy
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $bonus;

    /**
     * @var int
     */
    protected $score;

    /**
     * @var int
     */
    protected $lowerScore;

    /**
     * @var int
     */
    protected $upperScore;

    /**
     * @var int
     */
    protected $name;


    public function getId()
    {
        return $this->id;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getBonus()
    {
        return $this->bonus;
    }

    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
    }

    public function getlowerScore()
    {
        return $this->lowerScore;
    }

    public function setlowerScore($lowerScore)
    {
        $this->lowerScore = $lowerScore;
    }

    public function getupperScore()
    {
        return $this->upperScore;
    }

    public function setupperScore($upperScore)
    {
        $this->upperScore = $upperScore;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
