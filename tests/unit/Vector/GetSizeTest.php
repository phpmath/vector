<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Tests\Vector;

use PHPMath\Vector\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'getSize')]
final class GetSizeTest extends TestCase
{
    public function testReturnsNumberOfComponents(): void
    {
        // Arrange
        $vector = new Vector([1, 2, 3]);

        // Act
        $size = $vector->getSize();

        // Assert
        self::assertSame(3, $size);
    }
}
