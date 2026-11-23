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
#[CoversMethod(Vector2::class, 'withY')]
final class WithYTest extends TestCase
{
    public function testReturnsCopyWithNewY(): void
    {
        // Arrange
        $vector = new Vector2(1, 2);

        // Act
        $result = $vector->withY(5);

        // Assert
        self::assertSame([1.0, 5.0], $result->toArray());
        self::assertSame([1.0, 2.0], $vector->toArray());
    }
}
