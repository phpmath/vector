<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Exception\IndexOutOfRangeException;
use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'getElement')]
final class GetElementTest extends TestCase
{
    public function testReturnsElement(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $element = $vector->getElement(1);

        // Assert
        self::assertSame(2.0, $element);
    }

    public function testThrowsOnTooBigIndex(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);
        $this->expectException(IndexOutOfRangeException::class);

        // Act
        $vector->getElement(3);
    }

    public function testThrowsOnNegativeIndex(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);
        $this->expectException(IndexOutOfRangeException::class);

        // Act
        $vector->getElement(-1);
    }
}
