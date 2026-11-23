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
#[CoversMethod(Vector::class, 'getMaximumValue')]
final class GetMaximumValueTest extends TestCase
{
    public function testReturnsLargestComponent(): void
    {
        // Arrange
        $vector = new Vector([1, 7, -3]);

        // Act
        $max = $vector->getMaximumValue();

        // Assert
        self::assertSame(7.0, $max);
    }
}
