# Anper\Twig\TemplateCollector

[![Software License][ico-license]](LICENSE.md)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-ga]][link-ga]

## Install

``` bash
$ composer require anper/twig-template-collector
```

## Collect context

``` php
use Anper\Twig\TemplateCollector\Extension\CollectContextExtension;
use Anper\Twig\TemplateCollector\Context;

$extension = new CollectContextExtension(function (Context $profile){
    var_dump($profile)
});

$twigEnvironment->addExtension($loader);
```

## Collect templates

``` php
use Anper\Twig\TemplateCollector\Extension\CollectTemplateExtension;
use Anper\Twig\TemplateCollector\Template;

$extension = new CollectContextExtension(function (Template $profile){
    var_dump($profile)
});

$twigEnvironment->addExtension($loader);
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
