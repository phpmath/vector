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

use function iterator_to_array;

#[CoversClass(Vector::class)]
#[CoversMethod(Vector::class, 'getIterator')]
final class GetIteratorTest extends TestCase
{
    public function testIteratesOverComponents(): void
    {
        // Arrange
        $vector = new Vector([1, 2]);

        // Act
        $items = iterator_to_array($vector);

        // Assert
        self::assertSame([1.0, 2.0], $items);
    }
}
