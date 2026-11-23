<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const INF;
use const NAN;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector4::class, '__construct')]
final class ConstructorTest extends TestCase
{
    public function testStoresComponents(): void
    {
        // Arrange
        $w = 4.5;

        // Act
        $vector = new Vector4(1.5, 2.5, 3.5, $w);

        // Assert
        self::assertSame([1.5, 2.5, 3.5, 4.5], $vector->toArray());
    }

    public function testThrowsOnNonFiniteComponent1(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);

        // Act
        new Vector4(1, NAN, 1, 1);
    }

    public function testThrowsOnNonFiniteComponent2(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);

        // Act
        new Vector4(1, 1, 1, -INF);
    }
}
