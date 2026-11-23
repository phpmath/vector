---
title: Core concepts
intro: The few ideas you need to use the vector library well.
group: Getting started
order: 20
---

## Vectors are immutable

`Vector`, `Vector2`, `Vector3` and `Vector4` are readonly classes. Once created, a vector never changes. Methods such as `add()` or `negate()` return a new instance and leave the original untouched, so you can pass vectors around without defensive copies.

```php
use PHPMath\Vector\Vector2;

$position = new Vector2(1, 2);
$moved = $position->add(new Vector2(3, 4));

echo $position; // [1, 2]
echo $moved;    // [4, 6]
```

Operations return the same type they were called on. A `Vector2` stays a `Vector2`, a `Vector3` stays a `Vector3` and a `Vector4` stays a `Vector4`.

## Four classes

`Vector` holds one or more components. `Vector2`, `Vector3` and `Vector4` extend it and add named accessors such as `getX()` and `withX()`. `Vector3` also adds the cross product, and `Vector4` adds conversions to and from `Vector3` for homogeneous coordinates.

| Class | Components | Extras |
|---|---|---|
| `Vector` | One or more | Everything shared by all vectors. |
| `Vector2` | Two | `getX()`, `getY()`, `withX()`, `withY()`. |
| `Vector3` | Three | `getX()`, `getY()`, `getZ()`, `withX()`, `withY()`, `withZ()`, `crossProduct()`. |
| `Vector4` | Four | `getX()`, `getY()`, `getZ()`, `getW()`, `withX()`, `withY()`, `withZ()`, `withW()`, `fromVector3()`, `toVector3()`, `project()`. |

`Vector2`, `Vector3` and `Vector4` are `final`. You cannot extend them. See [Four dimensions](four-dimensions.md) for `Vector4`.

## Creating vectors

`Vector2`, `Vector3` and `Vector4` take one float per component. Whole numbers are converted to floats.

```php
use PHPMath\Vector\Vector2;
use PHPMath\Vector\Vector3;

echo new Vector2(1, 2);       // [1, 2]
echo new Vector3(0.5, 1, -2); // [0.5, 1, -2]
```

`Vector` takes an array of numbers. Every value is converted to a float and the keys are discarded, so the components are numbered from zero.

```php
use PHPMath\Vector\Vector;

echo new Vector([3, 4]);            // [3, 4]
echo new Vector(['a' => 1, 'b' => 2]); // [1, 2]
```

An empty array throws an `EmptyVectorException`, because a vector needs at least one component. A value that is not an int or a float throws an `InvalidComponentException`, and so does a numeric string such as `'1.5'` or a component that is `NAN` or infinite. A negative zero is stored as `0`.

```php
use PHPMath\Vector\Exception\EmptyVectorException;
use PHPMath\Vector\Vector;

try {
    new Vector([]);
} catch (EmptyVectorException $exception) {
    echo $exception->getMessage(); // A vector needs at least one component.
}
```

> [!NOTE]
> Components are PHP floats, so results follow normal floating point rules. For example `0.1 + 0.2` is not exactly `0.3`. See [Working with elements](elements.md#printing-vectors) for how vectors are printed.

## Finite components

A vector never starts with a `NAN` or infinite component. The constructors of `Vector`, `Vector2`, `Vector3` and `Vector4`, and `withElement()`, `withX()` and the other `with` methods, throw an `InvalidComponentException` for such a value. The results of operations are not checked, like in the other phpmath libraries. An overflow gives `INF`, and `isFinite()` tells whether all components are finite.

```php
use PHPMath\Vector\Vector;

$vector = (new Vector([1, 1e308]))->scale(10);

echo $vector;                           // [10, INF]
echo $vector->isFinite() ? 'yes' : 'no'; // no
```

## Reading values

`toArray()` returns the components as a list of floats. A vector can also be counted, looped over and printed.

```php
use PHPMath\Vector\Vector3;

$vector = new Vector3(1, 2, 3);

$vector->toArray(); // [1.0, 2.0, 3.0]
count($vector);     // 3
echo $vector;       // [1, 2, 3]
```

See [Working with elements](elements.md) for more.

## Operations take vectors of the same size

Methods that combine two vectors accept another `Vector`. The two must have the same number of components, otherwise a `SizeMismatchException` is thrown. A `Vector` and a `Vector3` can be combined as long as both have three components. The result has the type of the vector you called the method on.

```php
use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector3;

$a = new Vector3(1, 2, 3);
$b = new Vector([1, 1, 1]);

echo get_class($a->add($b)); // PHPMath\Vector\Vector3
echo get_class($b->add($a)); // PHPMath\Vector\Vector
```

## Errors

Every error the library throws on purpose implements the `VectorException` marker interface, so one `catch` block handles all of them. Each exception is a final class that extends a standard PHP exception. See [Errors and exceptions](errors.md) for the full list.
