<?php

namespace Andreshg112\ChuckNorrisJokes;

class JokeFactory
{
    /** @var array $jokes Vector de chistes. */
    protected $jokes = [
        "Chuck Norris' tears cure cancer. Too bad he has never cried. ",
        'The First rule of Chuck Norris is: you do not talk about Chuck Norris.',
        'Chuck Norris counted to infinity... Twice. ',
    ];

    public function __construct(array $jokes = null)
    {
        if ($jokes) {
            $this->jokes = $jokes;
        }
    }

    public function getRandomJoke()
    {
        return $this->jokes[array_rand($this->jokes)];
    }
}
