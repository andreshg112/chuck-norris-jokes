<?php

namespace Andreshg112\ChuckNorrisJokes\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Artisan;
use Andreshg112\ChuckNorrisJokes\Models\Joke;
use Andreshg112\ChuckNorrisJokes\Facades\ChuckNorris;
use Andreshg112\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Andreshg112\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ChuckNorrisJokesServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorrisJoke::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/../database/migrations/create_jokes_table.php.stub';

        (new \CreateJokesTable)->up();
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

        $this->assertSame('some joke'.PHP_EOL, $output);
    }

    /** @test */
    public function the_route_can_be_accessed()
    {
        ChuckNorris::shouldReceive('getRandomJoke')
            ->once()
            ->andReturn('some joke');

        $this->get('chuck-norris')
            ->assertViewIs('chuck-norris::joke')
            ->assertViewHas('joke', 'some joke')
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_access_the_database()
    {
        $joke = new Joke();
        $joke->joke = 'this is funny';
        $joke->save();

        $newJoke = Joke::find($joke->id);

        $this->assertSame($newJoke->joke, 'this is funny');
    }
}
