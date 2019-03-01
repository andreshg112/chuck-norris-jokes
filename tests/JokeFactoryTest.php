<?php

namespace Andreshg112\ChuckNorrisJokes\Tests;

use Andreshg112\ChuckNorrisJokes\JokeFactory;
use PHPUnit\Framework\TestCase;

class JokeFactoryTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_returns_a_random_joke()
    {
        $jokes = new JokeFactory([
            'This is a joke',
        ]);

        $joke = $jokes->getRandomJoke();

        $this->assertSame('This is a joke', $joke);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_returns_a_predefined_joke()
    {
        $chuckNorrisJokes = [
            "Chuck Norris' tears cure cancer. Too bad he has never cried. ",
            'The First rule of Chuck Norris is: you do not talk about Chuck Norris.',
            'Chuck Norris counted to infinity... Twice. ',
        ];

        $jokes = new JokeFactory;

        $joke = $jokes->getRandomJoke();

        $this->assertContains($joke, $chuckNorrisJokes);
    }
}
