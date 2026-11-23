---
title: Length and direction
intro: Measure a vector, turn it into a unit vector and find its smallest and largest component.
group: Guides
order: 50
---

## Length

The length of a vector is the distance from the origin to the point it describes. `getLength()` returns it as a float.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([3, 4]);

echo $vector->getLength(); // 5
```

## Squared length

`getLengthSquared()` returns the length multiplied by itself. It skips the square root, so it is cheaper. Use it to compare lengths, because a longer vector also has the larger squared length.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([3, 4]);

echo $vector->getLengthSquared(); // 25
```

## Normalising

Normalising a vector scales it to a length of 1, without changing its direction. The result is called a unit vector. `normalize()` returns it as a new vector. It divides by the largest absolute component first, so very large and very small vectors normalise correctly without overflow or underflow.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([3, 4]);
$unit = $vector->normalize();

echo $unit;              // [0.6, 0.8]
echo $unit->getLength(); // 1
```

> [!WARNING]
> A vector of length zero has no direction. `normalize()` throws a [`ZeroLengthException`](errors.md) for it. A vector with a `NAN` or infinite component, which is only possible after an operation overflowed, throws an [`InvalidComponentException`](errors.md).

```php
use PHPMath\Vector\Exception\ZeroLengthException;
use PHPMath\Vector\Vector2;

try {
    (new Vector2(0, 0))->normalize();
} catch (ZeroLengthException $exception) {
    echo $exception->getMessage(); // A vector with a length of zero cannot be normalized.
}
```

The next example normalises a vector whose length would overflow a float if it were computed directly.

```php
use PHPMath\Vector\Vector;

echo (new Vector([1e200, 1e200]))->normalize(); // [0.70710678118655, 0.70710678118655]
```

## Smallest and largest component

`getMinimumValue()` and `getMaximumValue()` return the lowest and highest component as floats.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([3, -1, 2]);

echo $vector->getMinimumValue(); // -1
echo $vector->getMaximumValue(); // 3
```
