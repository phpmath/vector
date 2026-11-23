<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Exception\ZeroWComponentException;
use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector4::class, 'project')]
final class ProjectTest extends TestCase
{
    public function testDividesByW(): void
    {
        // Arrange
        $vector = new Vector4(2, 4, 6, 2);

        // Act
        $result = $vector->project();

        // Assert
        self::assertSame([1.0, 2.0, 3.0], $result->toArray());
    }

    public function testPointWithWOneKeepsItsPosition(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, 1);

        // Act
        $result = $vector->project();

        // Assert
        self::assertSame([1.0, 2.0, 3.0], $result->toArray());
    }

    public function testNegativeWFlipsThePoint(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, -1);

        // Act
        $result = $vector->project();

        // Assert
        self::assertSame([-1.0, -2.0, -3.0], $result->toArray());
    }

    public function testDirectionCannotBeProjected(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, 0);

        // Assert
        $this->expectException(ZeroWComponentException::class);
        $this->expectExceptionMessage('A vector with w = 0 cannot be projected to three dimensions.');

        // Act
        $vector->project();
    }

    public function testOverflowGivesInfinityInsteadOfThrowing(): void
    {
        // Arrange
        $vector = new Vector4(1e308, 1, 1, 1e-10);

        // Act
        $result = $vector->project();

        // Assert
        self::assertFalse($result->isFinite());
    }
}
