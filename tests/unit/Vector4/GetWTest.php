<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector4;

use PHPMath\Vector\Vector4;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector4::class)]
#[CoversMethod(Vector4::class, 'getW')]
final class GetWTest extends TestCase
{
    public function testReturnsTheWComponent(): void
    {
        // Arrange
        $vector = new Vector4(1, 2, 3, 4);

        // Act
        $result = $vector->getW();

        // Assert
        self::assertSame(4.0, $result);
    }
}
