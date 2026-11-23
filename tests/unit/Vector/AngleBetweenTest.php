<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\SizeMismatchException;
use PHPMath\Vector\Exception\ZeroLengthException;
use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector3;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const M_PI;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'angleBetween')]
final class AngleBetweenTest extends TestCase
{
    public function testOrthogonalVectorsGiveHalfPi(): void
    {
        // Arrange
        $vector = new Vector([1, 0, 0]);

        // Act
        $angle = $vector->angleBetween(new Vector([0, 1, 0]));

        // Assert
        self::assertEqualsWithDelta(M_PI / 2, $angle, 1e-12);
    }

    public function testIsIndependentOfLength(): void
    {
        // Arrange
        $vector = new Vector([5, 0]);

        // Act
        $angle = $vector->angleBetween(new Vector([3, 3]));

        // Assert
        self::assertEqualsWithDelta(M_PI / 4, $angle, 1e-12);
    }

    public function testParallelVectorsGiveExactlyZero(): void
    {
        // Arrange
        $vector = new Vector3(1, 1, 0);

        // Act
        $angle = $vector->angleBetween(new Vector3(2, 2, 0));

        // Assert
        self::assertSame(0.0, $angle);
    }

    public function testOppositeVectorsGivePi(): void
    {
        // Arrange
        $vector = new Vector3(1, 1, 0);

        // Act
        $angle = $vector->angleBetween(new Vector3(-2, -2, 0));

        // Assert
        self::assertSame(M_PI, $angle);
    }

    public function testThrowsOnZeroVector(): void
    {
        // Arrange
        $vector = new Vector([1, 0]);
        $this->expectException(ZeroLengthException::class);

        // Act
        $vector->angleBetween(new Vector([0, 0]));
    }

    public function testThrowsOnDifferentSize(): void
    {
        // Arrange
        $vector = new Vector([1, 0]);
        $this->expectException(SizeMismatchException::class);

        // Act
        $vector->angleBetween(new Vector([1, 0, 0]));
    }

    public function testSizeIsCheckedBeforeZeroLength(): void
    {
        // Arrange
        $vector = new Vector([1, 0]);
        $this->expectException(SizeMismatchException::class);

        // Act
        $vector->angleBetween(new Vector([0, 0, 0]));
    }

    public function testThrowsWhenThisVectorIsZero(): void
    {
        // Arrange
        $vector = new Vector([0, 0]);
        $this->expectException(ZeroLengthException::class);

        // Act
        $vector->angleBetween(new Vector([1, 0]));
    }
}
