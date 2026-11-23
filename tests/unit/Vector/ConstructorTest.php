<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\EmptyVectorException;
use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

use const INF;
use const NAN;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, '__construct')]
final class ConstructorTest extends TestCase
{
    public function testThrowsOnEmptyComponents(): void
    {
        // Arrange
        $this->expectException(EmptyVectorException::class);

        // Act
        new Vector([]);
    }

    public function testThrowsOnNonNumericComponent(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component 0 must be an int or a float, string given.');

        // Act
        new Vector(['x']);
    }

    public function testThrowsOnNumericString(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component a must be an int or a float, string given.');

        // Act
        new Vector(['a' => '1.5']);
    }

    public function testThrowsOnNan(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component 1 must be finite.');

        // Act
        new Vector([1, NAN]);
    }

    public function testThrowsOnInfinity(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component 0 must be finite.');

        // Act
        new Vector([INF]);
    }

    public function testThrowsOnNegativeInfinity(): void
    {
        // Arrange
        $this->expectException(InvalidComponentException::class);
        $this->expectExceptionMessage('The component 1 must be finite.');

        // Act
        new Vector([1, -INF]);
    }

    public function testNormalisesNegativeZero(): void
    {
        // Arrange
        $components = [-0.0, 1];

        // Act
        $vector = new Vector($components);

        // Assert
        self::assertSame('0', (string) $vector->getElement(0));
    }

    public function testDiscardsKeysAndConvertsToFloats(): void
    {
        // Arrange
        $components = ['a' => 1, 'b' => 2.5];

        // Act
        $vector = new Vector($components);

        // Assert
        self::assertSame([1.0, 2.5], $vector->toArray());
    }
}
