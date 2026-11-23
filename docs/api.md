---
title: API reference
intro: Every public method of Vector, Vector2 and Vector3, grouped by purpose.
group: Reference
order: 70
layout: reference
---

Every method returns a new vector of the same type unless the return type says otherwise. `Vector` lives in `PHPMath\Vector\Vector`, and `Vector2` and `Vector3` extend it. All methods below are available on all three classes unless a heading says otherwise. Methods that take a `Vector` also accept a `Vector2` or `Vector3`.

## Construction

Create a vector from an array, or from named components with `Vector2` and `Vector3`.

### Vector::__construct()

```php
public function __construct(array $components)
```

Creates a vector. Values are converted to floats, the keys are discarded and a negative zero becomes `0`.

- **Parameters:** `$components` an array of ints or floats, with at least one value
- **Throws:** [EmptyVectorException](errors.md) if the array is empty
- **Throws:** [InvalidComponentException](errors.md) if a value is not an int or a float (a numeric string is rejected too), or is `NAN` or infinite

### Vector2::__construct()

```php
public function __construct(float $x, float $y)
```

Creates a two dimensional vector.

- **Parameters:** `$x` the first component, `$y` the second component
- **Throws:** [InvalidComponentException](errors.md) if a component is `NAN` or infinite

### Vector3::__construct()

```php
public function __construct(float $x, float $y, float $z)
```

Creates a three dimensional vector.

- **Parameters:** `$x` the first component, `$y` the second component, `$z` the third component
- **Throws:** [InvalidComponentException](errors.md) if a component is `NAN` or infinite

## Arithmetic

Add, subtract, scale and negate.

### add()

```php
public function add(Vector $vector): static
```

Adds a vector component by component. The result never holds a negative zero.

- **Parameters:** `$vector` the vector to add, of the same size
- **Returns:** a new vector of the same type as this one
- **Throws:** [SizeMismatchException](errors.md) if the sizes differ

### subtract()

```php
public function subtract(Vector $vector): static
```

Subtracts a vector component by component. The result never holds a negative zero.

- **Parameters:** `$vector` the vector to subtract, of the same size
- **Returns:** a new vector of the same type as this one
- **Throws:** [SizeMismatchException](errors.md) if the sizes differ

### scale()

```php
public function scale(float $scale): static
```

Multiplies every component by a factor. The result never holds a negative zero.

- **Parameters:** `$scale` the factor
- **Returns:** a new vector of the same type as this one

### negate()

```php
public function negate(): static
```

Reverses the direction. The length stays the same. Same as `scale(-1.0)`, so a component of `0` stays `0`.

- **Returns:** a new vector of the same type as this one

## Products and angles

Dot product, cross product and the angle between two vectors.

### dotProduct()

```php
public function dotProduct(Vector $vector): float
```

Multiplies the components pairwise and adds the results.

- **Parameters:** `$vector` the other vector, of the same size
- **Returns:** `float`
- **Throws:** [SizeMismatchException](errors.md) if the sizes differ

### Vector3::crossProduct()

```php
public function crossProduct(Vector3 $vector): Vector3
```

Returns a vector that is perpendicular to this vector and the given one.

- **Parameters:** `$vector` the other vector
- **Returns:** `Vector3`
- **Throws:** `TypeError` if the argument is a `Vector` and not a `Vector3`

### angleBetween()

```php
public function angleBetween(Vector $vector): float
```

Returns the angle between two vectors in radians, from 0 to pi. It uses the stable formula `2 * atan2(|| |b| * a - |a| * b ||, || |b| * a + |a| * b ||)`, so parallel vectors give exactly 0 and opposite vectors give pi.

- **Parameters:** `$vector` the other vector, of the same size
- **Returns:** `float` the angle in radians
- **Throws:** [SizeMismatchException](errors.md) if the sizes differ (checked first), or [ZeroLengthException](errors.md) if either vector has a length of zero

## Length and direction

Measure a vector and turn it into a unit vector.

### getLength()

```php
public function getLength(): float
```

Returns the length of the vector.

- **Returns:** `float`

### getLengthSquared()

```php
public function getLengthSquared(): float
```

Returns the length multiplied by itself, without taking a square root.

- **Returns:** `float`

### normalize()

```php
public function normalize(): static
```

Scales the vector to a length of 1, keeping its direction. The components are divided by the largest absolute component first, so huge and tiny vectors do not overflow or underflow.

- **Returns:** a new vector of the same type as this one
- **Throws:** [InvalidComponentException](errors.md) if a component is `NAN` or infinite, or [ZeroLengthException](errors.md) if the length is zero

### getMinimumValue()

```php
public function getMinimumValue(): float
```

Returns the lowest component.

- **Returns:** `float`

### getMaximumValue()

```php
public function getMaximumValue(): float
```

Returns the highest component.

- **Returns:** `float`

## Elements

Read, replace, count and iterate the components. `Vector2` and `Vector3` add named accessors.

### getElement()

```php
public function getElement(int $index): float
```

Returns the component at a zero based index.

- **Parameters:** `$index` the index
- **Returns:** `float`
- **Throws:** [IndexOutOfRangeException](errors.md) if the index does not exist

### withElement()

```php
public function withElement(int $index, float $value): static
```

Returns a copy with one component replaced.

- **Parameters:** `$index` the index, `$value` the new value
- **Returns:** a new vector of the same type as this one
- **Throws:** [IndexOutOfRangeException](errors.md) if the index does not exist, or [InvalidComponentException](errors.md) if the value is `NAN` or infinite

### isFinite()

```php
public function isFinite(): bool
```

Tells whether all components are finite. The constructor rejects `NAN` and infinite values, so this is only false for the result of an operation that overflowed. See [Core concepts](concepts.md#finite-components).

- **Returns:** `bool`

### getSize()

```php
public function getSize(): int
```

Returns the number of components.

- **Returns:** `int`

### count()

```php
public function count(): int
```

Returns the number of components. Implements `Countable`.

- **Returns:** `int`

### toArray()

```php
public function toArray(): array
```

Returns the components.

- **Returns:** `list<float>`

### getIterator()

```php
public function getIterator(): Traversable
```

Returns an iterator over the components. Implements `IteratorAggregate`, so a vector works in `foreach`.

- **Returns:** `Traversable<int, float>`

### Vector2::getX()

```php
public function getX(): float
```

Returns the component at index 0.

- **Returns:** `float`

### Vector2::withX()

```php
public function withX(float $x): Vector2
```

Returns a copy with the component at index 0 replaced.

- **Parameters:** `$x` the new value
- **Returns:** `Vector2`

### Vector2::getY()

```php
public function getY(): float
```

Returns the component at index 1.

- **Returns:** `float`

### Vector2::withY()

```php
public function withY(float $y): Vector2
```

Returns a copy with the component at index 1 replaced.

- **Parameters:** `$y` the new value
- **Returns:** `Vector2`

### Vector3::getX()

```php
public function getX(): float
```

Returns the component at index 0.

- **Returns:** `float`

### Vector3::withX()

```php
public function withX(float $x): Vector3
```

Returns a copy with the component at index 0 replaced.

- **Parameters:** `$x` the new value
- **Returns:** `Vector3`

### Vector3::getY()

```php
public function getY(): float
```

Returns the component at index 1.

- **Returns:** `float`

### Vector3::withY()

```php
public function withY(float $y): Vector3
```

Returns a copy with the component at index 1 replaced.

- **Parameters:** `$y` the new value
- **Returns:** `Vector3`

### Vector3::getZ()

```php
public function getZ(): float
```

Returns the component at index 2.

- **Returns:** `float`

### Vector3::withZ()

```php
public function withZ(float $z): Vector3
```

Returns a copy with the component at index 2 replaced.

- **Parameters:** `$z` the new value
- **Returns:** `Vector3`

## Vector4

A vector with four components, used for points and directions in homogeneous coordinates. It has everything `Vector` has, plus the methods below.

### Vector4::__construct()

```php
public function __construct(float $x, float $y, float $z, float $w)
```

Creates a vector with four components.

- **Parameters:** `$x`, `$y`, `$z` and `$w` the components
- **Throws:** [InvalidComponentException](errors.md) if a component is `NAN` or infinite

### Vector4::fromVector3()

```php
public static function fromVector3(Vector3 $vector, float $w = 1.0): self
```

Creates a `Vector4` from a `Vector3`. The default w of 1 makes a point, a w of 0 makes a direction.

- **Parameters:** `$vector` the three dimensional vector; `$w` the fourth component, default `1.0`
- **Returns:** `Vector4`

### Vector4::toVector3()

```php
public function toVector3(): Vector3
```

Drops the w component and keeps x, y and z unchanged.

- **Returns:** `Vector3`

### Vector4::project()

```php
public function project(): Vector3
```

Divides x, y and z by w, which turns homogeneous coordinates into a three dimensional point.

- **Returns:** `Vector3`
- **Throws:** [ZeroWComponentException](errors.md) if w is zero

### Vector4::getX()

```php
public function getX(): float
```

Returns the x component.

- **Returns:** `float`

### Vector4::withX()

```php
public function withX(float $x): self
```

Returns a copy with another x component. The original does not change.

- **Parameters:** `$x` the new x component
- **Returns:** `Vector4`

### Vector4::getY()

```php
public function getY(): float
```

Returns the y component.

- **Returns:** `float`

### Vector4::withY()

```php
public function withY(float $y): self
```

Returns a copy with another y component. The original does not change.

- **Parameters:** `$y` the new y component
- **Returns:** `Vector4`

### Vector4::getZ()

```php
public function getZ(): float
```

Returns the z component.

- **Returns:** `float`

### Vector4::withZ()

```php
public function withZ(float $z): self
```

Returns a copy with another z component. The original does not change.

- **Parameters:** `$z` the new z component
- **Returns:** `Vector4`

### Vector4::getW()

```php
public function getW(): float
```

Returns the w component.

- **Returns:** `float`

### Vector4::withW()

```php
public function withW(float $w): self
```

Returns a copy with another w component. The original does not change.

- **Parameters:** `$w` the new w component
- **Returns:** `Vector4`

## Conversion

Turn a vector into text.

### __toString()

```php
public function __toString(): string
```

Returns the components between square brackets, separated by a comma and a space, for example `[1, 2.5]`. Numbers are plain decimals with at most 14 decimals, no exponent, no trailing zeros and no negative zero. Implements `Stringable`.

- **Returns:** `string`

### toString()

```php
public function toString(): string
```

Returns the same text as `__toString()`.

- **Returns:** `string`
