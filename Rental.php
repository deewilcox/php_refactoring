<?php

class Rental
{
    /**
     * @var Movie
     */
    private $movie;

    /**
     * @var int
     */
    private $daysRented;

    /**
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct(Movie $movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    /**
     * This returns a Movie Object, which contains both the category and price code.
     * @return Movie
     */
    public function movie()
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function daysRented()
    {
        return $this->daysRented;
    }

    /**
     * @return int
     */
    public function category()
    {
        return $this->movie->category;
    }
}
