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
#[CoversMethod(Vector::class, 'scale')]
final class ScaleTest extends TestCase
{
    public function testScalesComponents(): void
    {
        // Arrange
        $vector = new Vector([1, -2, 3]);

        // Act
        $result = $vector->scale(2.5);

        // Assert
        self::assertSame([2.5, -5.0, 7.5], $result->toArray());
    }

    public function testDoesNotChangeOriginal(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);

        // Act
        $vector->scale(3);

        // Assert
        self::assertSame([1.0, 2.0], $vector->toArray());
    }

    public function testNeverReturnsNegativeZero(): void
    {
        // Arrange
        $vector = new Vector([0, 1]);

        // Act
        $result = $vector->scale(-2.0);

        // Assert
        self::assertSame('0', (string) $result->getElement(0));
    }
}
