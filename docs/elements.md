---
title: Working with elements
intro: Read, replace, count, iterate and print the components of a vector.
group: Guides
order: 60
---

## Reading an element

`getElement()` returns the component at a zero based index. The named accessors `getX()`, `getY()` and `getZ()` on `Vector2` and `Vector3` are shortcuts for the indexes 0, 1 and 2.

```php
use PHPMath\Vector\Vector3;

$vector = new Vector3(4, 5, 6);

echo $vector->getElement(1); // 5
echo $vector->getX();        // 4
echo $vector->getZ();        // 6
```

An index that does not exist, including a negative one, throws an [`IndexOutOfRangeException`](errors.md).

## Replacing an element

Vectors cannot be changed, so `withElement()` returns a copy with one component replaced. `Vector2` and `Vector3` also have `withX()`, `withY()` and `withZ()`. The original stays as it was.

```php
use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector3;

$vector = new Vector3(1, 2, 3);

echo $vector->withY(9);          // [1, 9, 3]
echo $vector->withElement(2, 7); // [1, 2, 7]
echo $vector;                    // [1, 2, 3]

echo (new Vector([1, 2]))->withElement(0, 5); // [5, 2]
```

`withElement()` throws an [`IndexOutOfRangeException`](errors.md) when the index does not exist. It cannot add a component, so the size of a vector never changes.

## Size and counting

`getSize()` returns the number of components. A vector is `Countable`, so `count()` gives the same number.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([3, -1, 2, 8]);

echo $vector->getSize(); // 4
echo count($vector);     // 4
```

## Iterating

A vector is `IteratorAggregate`, so you can loop over it with `foreach`. The keys are the indexes and the values are floats.

```php
use PHPMath\Vector\Vector3;

foreach (new Vector3(1, 2, 3) as $index => $value) {
    echo $index, '=', $value, ' '; // 0=1 1=2 2=3
}
```

## Converting to an array

`toArray()` returns the components as a list of floats.

```php
use PHPMath\Vector\Vector2;

$array = (new Vector2(1, 2))->toArray();

var_dump($array[0]); // float(1)
echo count($array);  // 2
```

## Printing vectors

A vector can be cast to a string. The text is the components between square brackets, separated by a comma and a space. `toString()` gives the same text. Numbers are printed as plain decimals with at most 14 decimals, no exponent and no trailing zeros, so `1.0` becomes `1` and `0.0000001` stays `0.0000001`. A negative zero is printed as `0`.

```php
use PHPMath\Vector\Vector;

$vector = new Vector([1.0, 1.5, 0.1 + 0.2]);

echo $vector;             // [1, 1.5, 0.3]
echo $vector->toString(); // [1, 1.5, 0.3]
```

> [!NOTE]
> The printed text is rounded to 14 decimals. The stored value is not. `0.1 + 0.2` prints as `0.3` but `toArray()` still holds `0.30000000000000004`. A value that overflowed to infinity prints as `INF`.
