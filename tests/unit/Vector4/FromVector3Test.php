<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Vector3;
use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector4::class, 'fromVector3')]
final class FromVector3Test extends TestCase
{
    public function testDefaultsToAPoint(): void
    {
        // Arrange
        $vector = new Vector3(1, 2, 3);

        // Act
        $result = Vector4::fromVector3($vector);

        // Assert
        self::assertSame([1.0, 2.0, 3.0, 1.0], $result->toArray());
    }

    public function testAcceptsADirection(): void
    {
        // Arrange
        $vector = new Vector3(1, 2, 3);

        // Act
        $result = Vector4::fromVector3($vector, 0.0);

        // Assert
        self::assertSame([1.0, 2.0, 3.0, 0.0], $result->toArray());
    }
}
