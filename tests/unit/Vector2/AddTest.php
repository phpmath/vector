<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector2;

use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector2;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector2::class)]
#[CoversMethod(Vector::class, 'add')]
#[CoversMethod(Vector::class, 'create')]
final class AddTest extends TestCase
{
    public function testReturnsVector2(): void
    {
        // Arrange
        $vector = new Vector2(1, 2);

        // Act
        $result = $vector->add(new Vector2(3, 4));

        // Assert
        self::assertInstanceOf(Vector2::class, $result);
        self::assertSame(4.0, $result->getX());
    }
}
