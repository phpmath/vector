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
#[CoversMethod(Vector2::class, 'withX')]
final class WithXTest extends TestCase
{
    public function testReturnsCopyWithNewX(): void
    {
        // Arrange
        $vector = new Vector2(1, 2);

        // Act
        $result = $vector->withX(5);

        // Assert
        self::assertSame([5.0, 2.0], $result->toArray());
        self::assertSame([1.0, 2.0], $vector->toArray());
    }
}
