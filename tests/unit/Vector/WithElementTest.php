<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\IndexOutOfRangeException;
use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const NAN;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'withElement')]
final class WithElementTest extends TestCase
{
    public function testReplacesElementInCopy(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $result = $vector->withElement(1, 9);

        // Assert
        self::assertSame([1.0, 9.0, 3.0], $result->toArray());
    }

    public function testDoesNotChangeOriginal(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $vector->withElement(1, 9);

        // Assert
        self::assertSame([1.0, 2.0, 3.0], $vector->toArray());
    }

    public function testThrowsOnInvalidIndex(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);
        $this->expectException(IndexOutOfRangeException::class);

        // Act
        $vector->withElement(3, 1);
    }

    public function testThrowsOnNonFiniteValue(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component 1 must be finite.');

        // Act
        $vector->withElement(1, NAN);
    }
}
