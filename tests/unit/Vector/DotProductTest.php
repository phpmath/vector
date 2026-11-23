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
#[CoversMethod(Vector::class, 'dotProduct')]
final class DotProductTest extends TestCase
{
    public function testCalculatesDotProduct(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $result = $vector->dotProduct(new Vector([4, -5, 6]));

        // Assert
        self::assertSame(12.0, $result);
    }

    public function testOrthogonalVectorsGiveZero(): void
    {
        // Arrange
        $vector = new Vector([1, 0]);

        // Act
        $result = $vector->dotProduct(new Vector([0, 1]));

        // Assert
        self::assertSame(0.0, $result);
    }

    public function testThrowsOnDifferentSize(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);
        $this->expectException(SizeMismatchException::class);

        // Act
        $vector->dotProduct(new Vector([1]));
    }
}
