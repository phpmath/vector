<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector2;

use PHPMath\Vector\Vector2;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector2::class)]
#[CoversMethod(Vector2::class, 'getY')]
final class GetYTest extends TestCase
{
    public function testReturnsY(): void
    {
        // Arrange
        $vector = new Vector2(1, 2);

        // Act
        $y = $vector->getY();

        // Assert
        self::assertSame(2.0, $y);
    }
}
