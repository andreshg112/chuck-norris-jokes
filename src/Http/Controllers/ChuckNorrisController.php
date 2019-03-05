<?php

namespace Andreshg112\ChuckNorrisJokes\Http\Controllers;

use Andreshg112\ChuckNorrisJokes\Facades\ChuckNorris;


class ChuckNorrisController
{
    public function __invoke()
    {
        return view('chuck-norris::joke', [
            'joke' => ChuckNorris::getRandomJoke(),
        ]);
    }
}
