<?php

namespace App\Highscore;

class Highscore
{
    /**
     * @var int
     */
    protected $id;

    

    /**
     * @var int§
     */
    protected $computerScore;

    /**
     * @var int§
     */
    protected $userScore;


    public function getId()
    {
        return $this->id;
    }

    public function getComputerScore()
    {
        return $this->computerScore;
    }

    public function setComputerScore($computerScore)
    {
        $this->computerScore = $computerScore;
    }

    public function getUserScore()
    {
        return $this->userScore;
    }

    public function setUserScore($userScore)
    {
        $this->userScore = $userScore;
    }
    
    
}