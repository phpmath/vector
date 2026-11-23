<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector4::class, 'withW')]
final class WithWTest extends TestCase
{
    public function testReplacesTheComponent(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, 4);

        // Act
        $result = $vector->withW(9);

        // Assert
        self::assertSame([1.0, 2.0, 3.0, 9.0], $result->toArray());
    }

    public function testLeavesTheOriginalUnchanged(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, 4);

        // Act
        $result = $vector->withW(9);

        // Assert
        self::assertNotSame($vector, $result);
        self::assertSame([1.0, 2.0, 3.0, 4.0], $vector->toArray());
    }
}
