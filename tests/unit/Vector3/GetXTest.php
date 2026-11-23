<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector3;

use PHPMath\Vector\Vector3;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector3::class)]
#[CoversMethod(Vector3::class, 'getX')]
final class GetXTest extends TestCase
{
    public function testReturnsX(): void
    {
        // Arrange
        $vector = new Vector3(1, 2, 3);

        // Act
        $v = $vector->getX();

        // Assert
        self::assertSame(1.0, $v);
    }
}
