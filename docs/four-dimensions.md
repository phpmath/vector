---
title: Four dimensions
intro: Use Vector4 for points and directions in homogeneous coordinates.
group: Guides
order: 65
---

## Why four components

A `Vector4` has an x, y, z and w component. The most common reason to use one is homogeneous coordinates: a point in 3D space gets a fourth component, so a 4x4 matrix can both rotate and move it. Moving (translating) a point cannot be written as a 3x3 matrix, but it can be written as a 4x4 matrix when the point has a w component.

```php
use PHPMath\Vector\Vector4;

$vector = new Vector4(1, 2, 3, 1);

echo $vector;              // [1, 2, 3, 1]
echo $vector->getW();      // 1
echo $vector->withW(0);    // [1, 2, 3, 0]
```

Like every vector in the library, a `Vector4` is immutable. `withW()` returns a new vector.

## Points and directions

A point has w = 1. A direction, such as a surface normal, has w = 0. The difference matters for transformations: a translation moves points and leaves directions alone, while rotations and scaling treat both the same way.

`fromVector3()` turns a `Vector3` into a `Vector4`. The w component defaults to 1, so the result is a point. Pass 0 to get a direction.

```php
use PHPMath\Vector\Vector3;
use PHPMath\Vector\Vector4;

$position = new Vector3(1, 2, 3);

echo Vector4::fromVector3($position);       // [1, 2, 3, 1]
echo Vector4::fromVector3($position, 0);    // [1, 2, 3, 0]
```

## Going back to three dimensions

`toVector3()` drops the w component and keeps x, y and z as they are. Use it for directions, or for points whose w is already 1.

```php
use PHPMath\Vector\Vector4;

echo (new Vector4(1, 2, 3, 4))->toVector3(); // [1, 2, 3]
```

`project()` divides x, y and z by w first. This is the "perspective divide", and it turns homogeneous coordinates into a real 3D point. A vector with w = 0 is a direction and has no position, so projecting it throws a `ZeroWComponentException`.

```php
use PHPMath\Vector\Exception\ZeroWComponentException;
use PHPMath\Vector\Vector4;

echo (new Vector4(2, 4, 6, 2))->project(); // [1, 2, 3]

try {
    (new Vector4(1, 2, 3, 0))->project();
} catch (ZeroWComponentException $exception) {
    echo $exception->getMessage(); // A vector with w = 0 cannot be projected to three dimensions.
}
```

## Everything else works as before

`Vector4` extends `Vector`, so addition, scaling, dot product, length and the other operations all work, and they return a `Vector4`. The cross product is the exception. It only exists in three dimensions, so it is only available on `Vector3`.

```php
use PHPMath\Vector\Vector4;

$sum = (new Vector4(1, 2, 3, 4))->add(new Vector4(1, 1, 1, 1));

echo $sum;             // [2, 3, 4, 5]
echo $sum::class;      // PHPMath\Vector\Vector4
```

## Transforming with a matrix

The `phpmath/matrix` library builds 4x4 matrices for translation, scaling and rotation, and applies them to a `Vector4` with `transform()`. See the [matrix documentation](/matrix/) for the details.
