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
#[CoversMethod(Vector::class, 'getLengthSquared')]
final class GetLengthSquaredTest extends TestCase
{
    public function testReturnsSquaredLength(): void
    {
        // Arrange
        $vector = new Vector([3, 4]);

        // Act
        $length = $vector->getLengthSquared();

        // Assert
        self::assertSame(25.0, $length);
    }
}
