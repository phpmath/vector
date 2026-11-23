---
title: Products and angles
intro: The dot product, the cross product and the angle between two vectors.
group: Guides
order: 40
---

## Dot product

The dot product multiplies two vectors component by component and adds up the results. It returns a single float, not a vector. It is zero when the vectors are perpendicular and positive when they point roughly the same way. Both vectors must have the same size.

```php
use PHPMath\Vector\Vector;

$a = new Vector([1, 2, 3]);
$b = new Vector([4, 5, 6]);

echo $a->dotProduct($b); // 32
```

Vectors of different sizes throw a [`SizeMismatchException`](errors.md).

## Cross product

The cross product of two 3D vectors is a third vector that is perpendicular to both. Its direction follows the right hand rule, so swapping the operands flips the result. It only exists for three dimensions, so `crossProduct()` is a method of `Vector3` and takes a `Vector3`.

```php
use PHPMath\Vector\Vector3;

$x = new Vector3(1, 0, 0);
$y = new Vector3(0, 1, 0);

echo $x->crossProduct($y); // [0, 0, 1]
echo $y->crossProduct($x); // [0, 0, -1]
```

Passing a plain `Vector` throws a `TypeError`, even when it has three components. Wrap the values in a `Vector3` first.

## Angle between vectors

`angleBetween()` returns the angle between two vectors in radians, from `0` to pi. It works for any number of components.

```php
use PHPMath\Vector\Vector3;

$a = new Vector3(1, 0, 0);
$b = new Vector3(0, 1, 0);

echo $a->angleBetween($b);                // 1.5707963267949
echo $a->angleBetween($a->negate());      // 3.1415926535898
echo rad2deg($a->angleBetween($b));       // 90
```

> [!WARNING]
> The angle with a vector of length zero is undefined. `angleBetween()` throws a [`ZeroLengthException`](errors.md) if either vector has no length. It throws a [`SizeMismatchException`](errors.md) when the sizes differ. The size is checked first, so a zero vector of another size reports the size problem.

> [!NOTE]
> The angle is calculated with the stable formula `2 * atan2(|| |b| * a - |a| * b ||, || |b| * a + |a| * b ||)`, not with `acos()`. It stays precise for vectors that point almost the same way: parallel vectors give exactly `0` and opposite vectors give pi.

```php
use PHPMath\Vector\Vector3;

$a = new Vector3(1, 1, 0);
$b = new Vector3(2, 2, 0);

echo $a->angleBetween($b);                     // 0
echo $a->angleBetween(new Vector3(-2, -2, 0)); // 3.1415926535898
```
