# andreshg112/chuck-norris-jokes

Muestra un chiste aleatorio sobre Chuck Norris.

## Installation

Instala el paquete usando composer

```bash
composer require andreshg112/chuck-norris-jokes
```

## Usage

```php
use Andreshg112\ChuckNorrisJokes\JokeFactory;

$jokes = new JokeFactory;

$joke = $jokes->getRandomJoke();
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)
