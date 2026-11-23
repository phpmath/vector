<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Exception\ZeroLengthException;
use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector2;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const M_SQRT1_2;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'normalize')]
final class NormalizeTest extends TestCase
{
    public function testCreatesUnitVector(): void
    {
        // Arrange
        $vector = new Vector([3, 4]);

        // Act
        $result = $vector->normalize();

        // Assert
        self::assertEqualsWithDelta([0.6, 0.8], $result->toArray(), 1e-12);
    }

    public function testThrowsOnZeroVector(): void
    {
        // Arrange
        $vector = new Vector([0, 0]);
        $this->expectException(ZeroLengthException::class);

        // Act
        $vector->normalize();
    }

    public function testNormalizesHugeVectorWithoutOverflow(): void
    {
        // Arrange
        $vector = new Vector([1e200, 1e200]);

        // Act
        $result = $vector->normalize();

        // Assert
        self::assertEqualsWithDelta([M_SQRT1_2, M_SQRT1_2], $result->toArray(), 1e-12);
    }

    public function testNormalizesTinyVectorWithoutUnderflow(): void
    {
        // Arrange
        $vector = new Vector([3e-200, 4e-200]);

        // Act
        $result = $vector->normalize();

        // Assert
        self::assertEqualsWithDelta([0.6, 0.8], $result->toArray(), 1e-12);
    }

    public function testKeepsTypeAndSign(): void
    {
        // Arrange
        $vector = new Vector2(-3, 4);

        // Act
        $result = $vector->normalize();

        // Assert
        self::assertEqualsWithDelta([-0.6, 0.8], $result->toArray(), 1e-12);
        self::assertInstanceOf(Vector2::class, $result);
    }

    public function testThrowsOnNonFiniteComponents(): void
    {
        // Arrange
        $vector = (new Vector([1e308, 1]))->scale(10.0);
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('A vector with non-finite components cannot be normalized.');

        // Act
        $vector->normalize();
    }
}
