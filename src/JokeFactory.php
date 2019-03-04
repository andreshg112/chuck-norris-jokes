<?php

namespace Andreshg112\ChuckNorrisJokes;

use function GuzzleHttp\json_decode;
use GuzzleHttp\Client;


class JokeFactory
{
    const API_ENDPOINT = 'https://api.icndb.com/jokes/random';

    /** @var \GuzzleHttp\Client $client Cliente de Guzzle. */
    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function getRandomJoke()
    {
        $response = $this->client->get(self::API_ENDPOINT);

        $joke =  json_decode($response->getBody()->getContents());

        return $joke->value->joke;
    }
}
