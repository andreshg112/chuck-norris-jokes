<?php

namespace Andreshg112\ChuckNorrisJokes\Tests;

use Andreshg112\ChuckNorrisJokes\JokeFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
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
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], '{ "type": "success", "value": { "id": 21, "joke": "Chuck Norris doesn\'t shower, he only takes blood baths.", "categories": [] } }'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $jokes = new JokeFactory($client);

        $joke = $jokes->getRandomJoke();

        $this->assertSame("Chuck Norris doesn't shower, he only takes blood baths.", $joke);
    }
}
