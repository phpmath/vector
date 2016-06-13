# vector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![SensioLabsInsight][ico-sensio]][link-sensio]

A PHP library to work with mathematical vectors.

## Getting started

It's recommended to install this library via [Composer](https://getcomposer.org).

```json
{
    "require": {
        "phpmath/vector": "1.0.0"
    }
}
```

The current master branch is considered stable. The badges on top of this document should confirm this.

## Requirements

This library runs on PHP 5.5, PHP 5.6, PHP 7 and HHVM. This library depends on phpmath/bignumber
which itself depends on the GMP extension.

## Features

This library supports the following operations:

* Fully unit tested.
* Basic classes such as Tuple, Vector, Vector2 and Vector3.
* Basic operations such as adding, scaling and subtracting.
* Performing dotProduct and crossProduct operations.
* Normalization
* Conjugate (negate - reverse)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phpmath/vector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phpmath/vector/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phpmath/vector.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phpmath/vector.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phpmath/vector.svg?style=flat-square
[ico-sensio]: https://img.shields.io/sensiolabs/i/543e6009-49ee-4239-91c4-985cfdd32d50.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phpmath/vector
[link-travis]: https://travis-ci.org/phpmath/vector
[link-scrutinizer]: https://scrutinizer-ci.com/g/phpmath/vector/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phpmath/vector
[link-downloads]: https://packagist.org/packages/phpmath/vector
[link-sensio]: https://insight.sensiolabs.com/projects/543e6009-49ee-4239-91c4-985cfdd32d50
