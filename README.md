# vector

[![Build Status](https://travis-ci.org/phpmath/vector.svg?branch=master)](https://travis-ci.org/phpmath/vector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phpmath/vector/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phpmath/vector/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phpmath/vector/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phpmath/vector/?branch=master)

A PHP library to work with mathematical vectors.

## Getting started

It's recommended to install this library via [Composer](https://getcomposer.org).

```json
{
    "require": {
        "phpmath/vector": "dev-master"
    }
}
```

The current master branch is considered stable. The badges on top of this document should confirm this.

## Requirements

This library runs on PHP 5.3, PHP 5.4, PHP 5.5, PHP 5.6, PHP 7 and HHVM. This library depends on phpmath/bignumber 
which itself depends on the GMP extension.

## Features

This library supports the following operations:

* Fully unit tested.
* Basic classes such as Tuple, Vector, Vector2 and Vector3.
* Basic operations such as adding, scaling and subtracting.
* Performing dotProduct and crossProduct operations.
* Normalization
* Conjugate (negate - reverse)
