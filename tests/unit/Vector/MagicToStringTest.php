<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, '__toString')]
final class MagicToStringTest extends TestCase
{
    public function testFormatsComponents(): void
    {
        // Arrange
        $vector = new Vector([1, 2.5]);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[1, 2.5]', $string);
    }

    public function testKeepsSmallNumbersPlain(): void
    {
        // Arrange
        $vector = new Vector([0.0000001, 1]);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[0.0000001, 1]', $string);
    }

    public function testNeverPrintsNegativeZero(): void
    {
        // Arrange
        $vector = new Vector([-0.0, -1]);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[0, -1]', $string);
    }

    public function testNeverPrintsExponent(): void
    {
        // Arrange
        $vector = new Vector([1e20, 1e-20]);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[100000000000000000000, 0]', $string);
    }

    public function testRoundsToFourteenDecimals(): void
    {
        // Arrange
        $vector = new Vector([1 / 3]);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[0.33333333333333]', $string);
    }

    public function testPrintsNonFiniteResults(): void
    {
        // Arrange
        $vector = (new Vector([1e308, 1]))->scale(10.0);

        // Act
        $string = (string) $vector;

        // Assert
        self::assertSame('[INF, 10]', $string);
    }
}
