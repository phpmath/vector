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
#[CoversMethod(Vector::class, 'toArray')]
final class ToArrayTest extends TestCase
{
    public function testReturnsComponentsAsList(): void
    {
        // Arrange
        $vector = new Vector(['a' => 1, 'b' => 2.5]);

        // Act
        $array = $vector->toArray();

        // Assert
        self::assertSame([1.0, 2.5], $array);
    }
}
