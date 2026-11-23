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
#[CoversMethod(Vector::class, 'isFinite')]
final class IsFiniteTest extends TestCase
{
    public function testIsTrueForFiniteComponents(): void
    {
        // Arrange
        $vector = new Vector([1, -2.5, 0]);

        // Act
        $result = $vector->isFinite();

        // Assert
        self::assertTrue($result);
    }

    public function testIsFalseAfterOverflow(): void
    {
        // Arrange
        $vector = (new Vector([1, 1e308]))->scale(10.0);

        // Act
        $result = $vector->isFinite();

        // Assert
        self::assertFalse($result);
    }
}
