<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector::class, 'create')]
final class AddTest extends TestCase
{
    public function testAddsComponents(): void
    {
        // Arrange
        $a = new Vector4(1, 2, 3, 4);

        // Act
        $result = $a->add(new Vector4(10, 20, 30, 40));

        // Assert
        self::assertInstanceOf(Vector4::class, $result);
        self::assertSame([11.0, 22.0, 33.0, 44.0], $result->toArray());
    }

    public function testNormalizeKeepsTheType(): void
    {
        // Arrange
        $a = new Vector4(0, 3, 0, 4);

        // Act
        $result = $a->normalize();

        // Assert
        self::assertInstanceOf(Vector4::class, $result);
        self::assertEqualsWithDelta(1.0, $result->getLength(), 1.0E-12);
    }
}
