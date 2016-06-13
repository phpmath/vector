<?php
/**
 * This file is part of phpmath/vector. (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 * @copyright Copyright (c) 2015-2016 phpmath. (https://github.com/phpmath/)
 * @license https://raw.githubusercontent.com/phpmath/vector/master/LICENSE.md MIT
 */

namespace PHP\Math\VectorTest;

use PHP\Math\Vector\Tuple;
use PHPUnit_Framework_TestCase;

class TupleTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        // ...

        // Act
        $tuple = new Tuple(range(1, 5));

        // Assert
        $this->assertEquals('[1.0000000000, 2.0000000000, 3.0000000000, 4.0000000000, 5.0000000000]', (string)$tuple);
    }

    public function testAdd()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $index = $tuple->addElement(6);

        // Assert
        $this->assertInternalType('integer', $index);
        $this->assertEquals(5, $index);
    }

    public function testGet()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $element = $tuple->getElement(1);

        // Assert
        $this->assertEquals('2', $element);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWithIndexTooBig()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $tuple->getElement(111);

        // Assert
        // ...
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWithIndexTooSmall()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $tuple->getElement(-111);

        // Assert
        // ...
    }

    public function testRemove()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $element = $tuple->removeElementIndex(0);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $element);
        $this->assertEquals(1, (string)$element);
    }

    public function testRemoveInvalidIndex()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $element = $tuple->removeElementIndex(123);

        // Assert
        $this->assertNull($element);
    }

    public function testRemoveElement()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $element = $tuple->removeElement(2);

        // Assert
        $this->assertTrue($element);
    }

    public function testRemoveElementInvalidElement()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $element = $tuple->removeElement(123);

        // Assert
        $this->assertFalse($element);
    }

    public function testSet()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $tuple->setElement(1, 0);

        // Assert
        $this->assertEquals('0', $tuple->getElement(1));
    }

    public function testSetWithIndexTooBig()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $tuple->setElement(111, 0);

        // Assert
        $this->assertCount(112, $tuple);
        $this->assertEquals('0', $tuple->getElement(111));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetWithIndexTooSmall()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $tuple->setElement(-111, 0);

        // Assert
        // ...
    }

    public function testGetSize()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $size = $tuple->getSize();

        // Assert
        $this->assertEquals(5, $size);
    }

    public function testGetMaximumValue()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $size = $tuple->getMaximumValue();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $size);
        $this->assertEquals('5', $size->getValue());
    }

    public function testGetMinimumValue()
    {
        // Arrange
        $tuple = new Tuple(range(1, 5));

        // Act
        $size = $tuple->getMinimumValue();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $size);
        $this->assertEquals('1', $size->getValue());
    }
}
