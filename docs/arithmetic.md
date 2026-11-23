---
title: Arithmetic
intro: Add, subtract, scale and negate vectors.
group: Guides
order: 30
---

## Adding and subtracting

`add()` and `subtract()` take another vector of the same size and work component by component. Both return a new vector.

```php
use PHPMath\Vector\Vector2;

$a = new Vector2(5, 7);
$b = new Vector2(2, 3);

echo $a->add($b);      // [7, 10]
echo $a->subtract($b); // [3, 4]
```

> [!WARNING]
> Both vectors must have the same number of components. Otherwise `add()` and `subtract()` throw a [`SizeMismatchException`](errors.md).

```php
use PHPMath\Vector\Exception\SizeMismatchException;
use PHPMath\Vector\Vector;

try {
    (new Vector([1, 2]))->add(new Vector([1, 2, 3]));
} catch (SizeMismatchException $exception) {
    echo $exception->getMessage(); // Invalid vector provided, should be of the same size.
}
```

## Scaling

`scale()` multiplies every component by a number. A factor above 1 makes the vector longer, a factor between 0 and 1 makes it shorter, and a negative factor also flips its direction.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([1, 2]);

echo $vector->scale(3);   // [3, 6]
echo $vector->scale(0.5); // [0.5, 1]
echo $vector->scale(-1);  // [-1, -2]
```

## Negating

`negate()` returns a vector with the same length that points the opposite way. It is the same as scaling by `-1`.

```php
use PHPMath\Vector\Vector3;

$vector = new Vector3(1, -2, 3);

echo $vector->negate(); // [-1, 2, -3]
```

> [!NOTE]
> Floats have a negative zero. The library never keeps one: `negate()`, `scale()`, `add()` and `subtract()` turn a negative zero in the result into `0`, so negating a component that is `0` gives `0`.

```php
use PHPMath\Vector\Vector;

echo (new Vector([0, 1]))->negate(); // [0, -1]
```
