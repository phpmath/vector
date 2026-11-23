---
title: Errors and exceptions
intro: What can go wrong and how to catch it.
group: Reference
order: 80
---

## Library exceptions

Every exception the library throws on purpose implements the marker interface `PHPMath\Vector\Exception\VectorException`, which extends `Throwable`. Catch it to handle all of them at once, and catch a specific class when you want to react to one cause. Each exception is a final class named after its cause and extends exactly one standard PHP exception.

```php
use PHPMath\Vector\Exception\VectorException;
use PHPMath\Vector\Vector;

try {
    (new Vector([1, 2]))->getElement(5);
} catch (VectorException $exception) {
    echo $exception::class, ': ', $exception->getMessage();
}
```

The code above prints this.

```text
PHPMath\Vector\Exception\IndexOutOfRangeException: The index 5 is invalid.
```

## Exception classes

This table lists every exception class, the PHP exception it extends, when it is thrown and the message it uses. All classes live in the `PHPMath\Vector\Exception` namespace.

| Exception | Extends | Thrown by | Condition | Message |
|---|---|---|---|---|
| `EmptyVectorException` | `InvalidArgumentException` | `new Vector()` | The array is empty. | `A vector needs at least one component.` |
| `InvalidComponentException` | `InvalidArgumentException` | `new Vector()`, `new Vector2()`, `new Vector3()`, `new Vector4()`, `withElement()`, `withX()` and the other `with` methods, `normalize()` | A component is not an int or a float (a numeric string too), or is `NAN` or infinite. `normalize()` throws it when a component is not finite. | `The component 0 must be an int or a float, string given.`, `The component 1 must be finite.` or `A vector with non-finite components cannot be normalized.` |
| `SizeMismatchException` | `InvalidArgumentException` | `add()`, `subtract()`, `dotProduct()`, `angleBetween()` | The other vector has a different size. | `Invalid vector provided, should be of the same size.` |
| `IndexOutOfRangeException` | `OutOfRangeException` | `getElement()`, `withElement()` | The index does not exist, including negative indexes. | `The index 5 is invalid.` |
| `ZeroLengthException` | `DomainException` | `normalize()`, `angleBetween()` | The vector, or for `angleBetween()` one of the vectors, has a length of zero. | `A vector with a length of zero cannot be normalized.` or `The angle with a vector of length zero is undefined.` |
| `ZeroWComponentException` | `DomainException` | `Vector4::project()` | The w component is zero. | `A vector with w = 0 cannot be projected to three dimensions.` |

`getLength()` and `getLengthSquared()` use `dotProduct()` on the vector itself, so they never throw.

> [!NOTE]
> `angleBetween()` checks the size first. When one vector has a length of zero and the sizes also differ, you get a `SizeMismatchException`, not a `ZeroLengthException`.

## TypeError

Type errors are not wrapped. They are PHP's own `TypeError`.

| Method | Condition |
|---|---|
| `crossProduct()` | The argument is a `Vector` and not a `Vector3`. |
| `add()`, `subtract()`, `dotProduct()`, `angleBetween()` | The argument is not a `Vector`. |

## Floating point edge cases

These cases do not throw, they follow the rules of PHP floats.

- A very long vector can overflow. `getLength()` of `[1e200, 1e200]` is `INF`.
- The results of operations are not checked, so an overflow gives a vector with `INF` components. Use `isFinite()` to detect it. `normalize()` on such a vector throws an `InvalidComponentException`.

## Handling untrusted input

Wrap the constructor in a `try` block to handle bad input. Use `VectorException` to catch every library error at once.

```php
use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Vector;

try {
    new Vector(['1.5']);
} catch (InvalidComponentException $exception) {
    echo $exception->getMessage(); // The component 0 must be an int or a float, string given.
}
```

The next example only handles an empty array.

```php
use PHPMath\Vector\Exception\EmptyVectorException;
use PHPMath\Vector\Vector;

$input = [];

try {
    $vector = new Vector($input);
} catch (EmptyVectorException) {
    // no components given
}
```
