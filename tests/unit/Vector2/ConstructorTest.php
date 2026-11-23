<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector2;

use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Vector2;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const INF;
use const NAN;

#[CoversClass(Vector2::class)]
#[CoversMethod(Vector2::class, '__construct')]
final class ConstructorTest extends TestCase
{
    public function testStoresComponents(): void
    {
        // Arrange
        $x = 1.5;

        // Act
        $vector = new Vector2($x, 2.5);

        // Assert
        self::assertSame([1.5, 2.5], $vector->toArray());
    }

    public function testThrowsOnNonFiniteComponent1(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);

        // Act
        new Vector2(NAN, 1);
    }

    public function testThrowsOnNonFiniteComponent2(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);

        // Act
        new Vector2(1, INF);
    }
}
