<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\SizeMismatchException;
use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'subtract')]
final class SubtractTest extends TestCase
{
    public function testSubtractsComponents(): void
    {
        // Arrange
        $vector = new Vector([4, 5, 6]);

        // Act
        $result = $vector->subtract(new Vector([1, 2, 3]));

        // Assert
        self::assertSame([3.0, 3.0, 3.0], $result->toArray());
    }

    public function testDoesNotChangeOriginal(): void
    {
        // Arrange
        $vector = new Vector([4, 5]);

        // Act
        $vector->subtract(new Vector([1, 1]));

        // Assert
        self::assertSame([4.0, 5.0], $vector->toArray());
    }

    public function testThrowsOnDifferentSize(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);
        $this->expectException(SizeMismatchException::class);

        // Act
        $vector->subtract(new Vector([1, 2, 3]));
    }

    public function testNeverReturnsNegativeZero(): void
    {
        // Arrange
        $vector = new Vector([0, 1]);

        // Act
        $result = $vector->subtract(new Vector([0, 1]));

        // Assert
        self::assertSame('0', (string) $result->getElement(0));
    }
}
