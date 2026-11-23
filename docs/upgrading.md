---
title: Upgrading from 1.x
intro: This version makes vectors immutable, drops BigNumber and renames the namespace.
group: Reference
order: 90
---

## Summary of changes

This version is a breaking release. These are the changes that affect your code.

- `Tuple` and `VectorUtils` are removed.
- Vectors are readonly. Operations return a new vector instead of changing the existing one.
- `setX()`, `setY()` and `setZ()` are replaced by `withX()`, `withY()` and `withZ()`. `setElement()` becomes `withElement()`.
- `addElement()`, `removeElement()` and `removeElementIndex()` are removed. The size of a vector is fixed.
- Vectors are float based. The `phpmath/bignumber` dependency is removed.
- The namespace changes from `PHP\Math\Vector` to `PHPMath\Vector`.
- PHP 8.4 or newer is required.
- `Vector3` no longer extends `Vector2`.
- `conjugate()` and `reverse()` are removed, use `negate()`. `getMagnitude()` is removed, use `getLength()`.
- Components must be an int or a float and finite. Numeric strings, `NAN` and infinite values throw an `InvalidComponentException`, where a bare `TypeError` was thrown before for non numbers.
- `angleBetween()` uses a stable formula, checks the size before the zero length, and gives exactly `0` for parallel vectors.
- `normalize()` copes with huge and tiny vectors, and operations never return a negative zero.
- Vectors are printed as plain decimals with at most 14 decimals, never in exponent notation.
- `isFinite()` is new.
- Errors are thrown as specific exception classes that implement `VectorException`. They still extend PHP's standard exceptions, so a `catch` for `InvalidArgumentException` keeps working for most cases. See [Errors and exceptions](errors.md).

## Step by step

Follow these steps to move an existing project from 1.x.

### 1. Update the namespace

Change the imports. The class names `Vector`, `Vector2` and `Vector3` stay the same.

```php
// before
use PHP\Math\Vector\Vector3;

// after
use PHPMath\Vector\Vector3;
```

### 2. Replace Tuple and array access

`Tuple` was based on `ArrayObject`. It is gone, and so is array access such as `$vector[0]`. Use `getElement()` to read a component, `toArray()` for an array and `foreach` to loop.

```php
// before
$value = $vector[0];

// after
$value = $vector->getElement(0);
```

Code that added or removed components with `addElement()`, `removeElement()` or `removeElementIndex()` must build a new `Vector` from an array.

### 3. Replace mutable code

In 1.x, `add()`, `subtract()`, `scale()`, `negate()` and `normalize()` changed the vector and returned `$this`. Now they return a new vector and leave the original alone. Assign the result.

```php
// before
$vector->add($other);

// after
$vector = $vector->add($other);
```

The same applies to setters.

```php
// before
$vector->setX(5);

// after
$vector = $vector->withX(5);
```

### 4. Replace VectorUtils

The static helpers are now methods. `VectorUtils::add()` and `VectorUtils::subtract()` return a new vector, just like the methods do.

```php
// before
$sum = VectorUtils::add($a, $b);
$angle = VectorUtils::angleBetween($a, $b);

// after
$sum = $a->add($b);
$angle = $a->angleBetween($b);
```

`angleBetween()` now divides the dot product by both lengths. In 1.x it only took the `acos()` of the dot product, which is only correct for unit vectors. Results change for vectors that are not normalised.

### 5. Replace BigNumber values

`getLength()`, `getLengthSquared()`, `dotProduct()`, `getElement()` and the other getters used to return `BigNumber` objects. They now return plain floats, and the constructors take ints or floats.

```php
// before
$length = $vector->getLength()->getValue();

// after
$length = $vector->getLength();
```

> [!WARNING]
> Floats have limited precision, while `BigNumber` could be exact. If you relied on exact decimal results, compare floats with a small tolerance instead of `==`.

### 6. Check the class hierarchy

`Vector3` used to extend `Vector2`. Both are now `final` and extend `Vector` directly, so an `instanceof Vector2` check is false for a `Vector3`. Use `Vector` as the type when you accept both.
