<?php

namespace PHP\Math\VectorTest;

use PHP\Math\Vector\Vector3;
use PHPUnit_Framework_TestCase;

class Vector3Test extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        $vector = new Vector3(123, 456, 789);

        // Act
        // ...

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getZ());
        $this->assertEquals('789.0', $vector->getZ());
    }

    public function testCrossProduct()
    {
        // Arrange
        $vector1 = new Vector3(1, 0, 0);
        $vector2 = new Vector3(0, 1, 0);

        // Act
        $crossProduct = $vector1->crossProduct($vector2);

        // Assert
        $this->assertInstanceOf('PHP\Math\Vector\Vector3', $crossProduct);
        $this->assertEquals('[0.0000000000, 0.0000000000, 1.0000000000]', $crossProduct->toString());
    }

    public function testGetSetZ()
    {
        // Arrange
        $vector = new Vector3(0, 0, 0);

        // Act
        $vector->setZ(123);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getZ());
        $this->assertEquals('123.0', $vector->getZ());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidElement()
    {
        // Arrange
        $vector = new Vector3(0, 0, 0);

        // Act
        $vector->getElement(123);

        // Assert
        // ...
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetInvalidElement()
    {
        // Arrange
        $vector = new Vector3(0, 0, 0);

        // Act
        $vector->setElement(123, 0);

        // Assert
        // ...
    }
}
