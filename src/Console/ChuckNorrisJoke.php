<?php

namespace Andreshg112\ChuckNorrisJokes\Console;

use Illuminate\Console\Command;
use Andreshg112\ChuckNorrisJokes\Facades\ChuckNorris;

class ChuckNorrisJoke extends Command
{
    protected $signature = 'chuck-norris';

    protected $description = 'Muestra un chiste sobre Chuck Norris en la consola.';

    public function handle()
    {
        $this->info(ChuckNorris::getRandomJoke());
    }
}
