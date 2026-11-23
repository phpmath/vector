---
title: Introduction
intro: Immutable 2D, 3D, 4D and n-dimensional vectors for PHP. Every vector is a readonly value object made of floats.
group: Getting started
order: 10
---

## Requirements

The library is plain PHP and has no runtime dependencies.

- PHP 8.4 or newer

## Installation

Install the library with Composer.

```bash
composer require phpmath/vector
```

## A first example

Create a vector from its components, then combine it with another one. A vector is a list of numbers, for example a point or a direction in space.

```php
use PHPMath\Vector\Vector3;

$a = new Vector3(1, 0, 0);
$b = new Vector3(0, 1, 0);

$sum = $a->add($b);

echo $sum; // [1, 1, 0]
echo $a;   // [1, 0, 0]
```

Calling `add()` did not change `$a`. It returned a new `Vector3`. This is true for every operation in the library.

## Where to go next

Start with the core concepts, or jump straight to the topic you need.

<div class="cards"><a href="concepts.md"><strong>Core concepts</strong><span>Immutability, creating vectors and reading values.</span></a><a href="arithmetic.md"><strong>Arithmetic</strong><span>Add, subtract, scale and negate.</span></a><a href="products-and-angles.md"><strong>Products and angles</strong><span>Dot product, cross product and the angle between vectors.</span></a><a href="length-and-direction.md"><strong>Length and direction</strong><span>Length, normalisation, minimum and maximum.</span></a><a href="elements.md"><strong>Working with elements</strong><span>Read, replace, count and iterate components.</span></a><a href="four-dimensions.md"><strong>Four dimensions</strong><span>Points and directions in homogeneous coordinates.</span></a><a href="api.md"><strong>API reference</strong><span>Every method with its parameters and errors.</span></a></div>
