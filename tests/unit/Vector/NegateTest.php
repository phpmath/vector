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
#[CoversMethod(Vector::class, 'negate')]
final class NegateTest extends TestCase
{
    public function testReversesSigns(): void
    {
        // Arrange
        $vector = new Vector([1, -2, 0]);

        // Act
        $result = $vector->negate();

        // Assert
        self::assertSame([-1.0, 2.0, 0.0], $result->toArray());
    }

    public function testNeverReturnsNegativeZero(): void
    {
        // Arrange
        $vector = new Vector([0, 1]);

        // Act
        $result = $vector->negate();

        // Assert
        self::assertSame('0', (string) $result->getElement(0));
    }
}
