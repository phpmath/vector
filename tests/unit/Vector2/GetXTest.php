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
#[CoversMethod(Vector2::class, 'getX')]
final class GetXTest extends TestCase
{
    public function testReturnsX(): void
    {
        // Arrange
        $vector = new Vector2(1, 2);

        // Act
        $x = $vector->getX();

        // Assert
        self::assertSame(1.0, $x);
    }
}
