<?php

namespace App\Book;

class Book
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $writer;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var int§
     */
    protected $ISBN;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getISBN()
    {
        return $this->ISBN;
    }

    public function setISBN($ISBN)
    {
        $this->ISBN = $ISBN;
    }
    public function getWriter()
    {
        return $this->writer;
    }

    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}

