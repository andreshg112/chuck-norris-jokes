<?php

namespace Andreshg112\ChuckNorrisJokes\Console;

use Andreshg112\ChuckNorrisJokes\Facades\ChuckNorris;
use Illuminate\Console\Command;

class ChuckNorrisJoke extends Command
{
    protected $signature = 'chuck-norris';

    protected $description = 'Muestra un chiste sobre Chuck Norris en la consola.';

    public function handle()
    {
        $this->info(ChuckNorris::getRandomJoke());
    }
}
