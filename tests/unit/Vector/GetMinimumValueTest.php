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
#[CoversMethod(Vector::class, 'getMinimumValue')]
final class GetMinimumValueTest extends TestCase
{
    public function testReturnsSmallestComponent(): void
    {
        // Arrange
        $vector = new Vector([1, 7, -3]);

        // Act
        $min = $vector->getMinimumValue();

        // Assert
        self::assertSame(-3.0, $min);
    }
}
