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
#[CoversMethod(Vector::class, 'add')]
final class AddTest extends TestCase
{
    public function testAddsComponents(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $result = $vector->add(new Vector([4, 5, 6]));

        // Assert
        self::assertSame([5.0, 7.0, 9.0], $result->toArray());
    }

    public function testDoesNotChangeOriginal(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);

        // Act
        $vector->add(new Vector([3, 4]));

        // Assert
        self::assertSame([1.0, 2.0], $vector->toArray());
    }

    public function testThrowsOnDifferentSize(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);
        $this->expectException(SizeMismatchException::class);

        // Act
        $vector->add(new Vector([1, 2, 3]));
    }

    public function testNeverReturnsNegativeZero(): void
    {
        // Arrange
        $vector = new Vector([-0.0, 1]);

        // Act
        $result = $vector->add(new Vector([-0.0, 1]));

        // Assert
        self::assertSame('0', (string) $result->getElement(0));
    }
}
