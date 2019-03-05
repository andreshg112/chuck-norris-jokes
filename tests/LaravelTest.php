<?php

namespace Andreshg112\ChuckNorrisJokes\Tests;

use Andreshg112\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Andreshg112\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Andreshg112\ChuckNorrisJokes\Facades\ChuckNorris;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ChuckNorrisJokesServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class,
        ];
    }

    /** @test */
    public function the_console_command_returns_a_joke()
    {
        $this->withoutMockingConsoleOutput();

        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $this->artisan('chuck-norris');

        $output = Artisan::output();

        $this->assertSame('some joke' . PHP_EOL, $output);
    }

    /** @test */
    public function the_route_can_be_accessed()
    {
        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $this->get('chuck-norris')
            ->assertStatus(200)
            ->assertSee('some joke');
    }
}
