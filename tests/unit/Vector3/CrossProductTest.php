<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector3;

use PHPMath\Vector\Vector3;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector3::class)]
#[CoversMethod(Vector3::class, 'crossProduct')]
final class CrossProductTest extends TestCase
{
    public function testCalculatesCrossProduct(): void
    {
        // Arrange
        $vector = new Vector3(1, 0, 0);

        // Act
        $result = $vector->crossProduct(new Vector3(0, 1, 0));

        // Assert
        self::assertSame([0.0, 0.0, 1.0], $result->toArray());
    }

    public function testIsAntiCommutative(): void
    {
        // Arrange
        $a = new Vector3(1, 2, 3);
        $b = new Vector3(4, 5, 6);

        // Act
        $result = $a->crossProduct($b);

        // Assert
        self::assertSame([-3.0, 6.0, -3.0], $result->toArray());
        self::assertSame([3.0, -6.0, 3.0], $b->crossProduct($a)->toArray());
    }

    public function testOverflowGivesInfinityInsteadOfThrowing(): void
    {
        // Arrange
        $vector = new Vector3(1e308, 0, 0);

        // Act
        $result = $vector->crossProduct(new Vector3(0, 1e308, 0));

        // Assert
        self::assertFalse($result->isFinite());
    }
}
