<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector3;

use PHPMath\Vector\Vector;
use PHPMath\Vector\Vector3;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector3::class)]
#[CoversMethod(Vector::class, 'add')]
#[CoversMethod(Vector::class, 'create')]
final class AddTest extends TestCase
{
    public function testReturnsVector3(): void
    {
        // Arrange
        $vector = new Vector3(1, 2, 3);

        // Act
        $result = $vector->add(new Vector3(1, 1, 1));

        // Assert
        self::assertInstanceOf(Vector3::class, $result);
        self::assertSame(4.0, $result->getZ());
    }
}
