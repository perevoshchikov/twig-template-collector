# Anper\TwigTemplateCollector

[![Software License][ico-license]](LICENSE.md)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-ga]][link-ga]

"twig/twig": "^1.34|^2.4|^3.0"

## Install

``` bash
$ composer require anper/twig-template-collector
```

## Usage

``` php
use Anper\TwigTemplateCollector;

$package = new Package();
echo $package->echoPhrase('Hello World!');
```

## Test

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email anper3.5@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/anper/twig-template-collector.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-ga]: https://github.com/perevoshchikov/twig-template-collector/workflows/Tests/badge.svg

[link-packagist]: https://packagist.org/packages/anper/twig-template-collector
[link-ga]: https://github.com/perevoshchikov/twig-template-collector/actions
