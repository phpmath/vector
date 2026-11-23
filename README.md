# vector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![CI][ico-ci]][link-ci]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP library to work with mathematical vectors.

## Documentation

The full documentation is at https://phpmath.github.io/vector/. Every change is listed in the [changelog](CHANGELOG.md) and every release on the [releases page](https://github.com/phpmath/vector/releases).

## Install

```bash
composer require phpmath/vector
```

## Requirements

- PHP 8.4 or newer

## Usage

Every vector is an immutable value object. Operations never change the instance they are
called on, they return a new instance.

``` php
use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector3;

$a = new Vector3(1, 0, 0);
$b = new Vector3(0, 1, 0);

$cross = $a->crossProduct($b); // Vector3 [0, 0, 1]
$sum = $a->add($b);            // Vector3 [1, 1, 0]
$angle = $a->angleBetween($b); // pi / 2

$vector = new Vector([3, 4]);
echo $vector->getLength();     // 5
```

## Features

* `Vector` (any number of components), `Vector2`, `Vector3` and `Vector4`.
* Adding, subtracting, scaling and negating .
* Dot product, cross product (`Vector3`) and the angle between two vectors.
* Length, squared length and normalization.
* `Vector4` for homogeneous coordinates, with `fromVector3()`, `toVector3()` and `project()`.
* Replacing a component with `withElement()` (`withX()`, `withY()` and `withZ()`), which returns a copy.

## Development

```bash
composer test
composer test-coverage
composer analyse
composer check-style
composer fix-style
```

## Contributing

All contributions are welcome. Open an issue or a pull request on GitHub. Please follow the coding standard and add tests.

## Security

If you discover a security issue, please create an issue in the issue tracker.

## Credits

- [Walter Tamboer](https://github.com/waltertamboer)
- [All contributors](https://github.com/phpmath/vector/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/vector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ci]: https://img.shields.io/github/actions/workflow/status/phpmath/vector/ci.yml?branch=master&style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/vector.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/vector
[link-ci]: https://github.com/phpmath/vector/actions/workflows/ci.yml
[link-downloads]: https://packagist.org/packages/phpmath/vector/stats
