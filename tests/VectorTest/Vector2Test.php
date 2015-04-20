<?php

namespace PHP\Math\VectorTest;

use PHP\Math\Vector\Vector2;
use PHPUnit_Framework_TestCase;

class Vector2Test extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        $vector = new Vector2(123, 456);

        // Act
        // ...

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getX());
        $this->assertEquals('123.0', $vector->getX());

        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getY());
        $this->assertEquals('456.0', $vector->getY());
    }

    public function testGetSetX()
    {
        // Arrange
        $vector = new Vector2(0, 0);

        // Act
        $vector->setX(123);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getX());
        $this->assertEquals('123.0', $vector->getX());
    }

    public function testGetSetY()
    {
        // Arrange
        $vector = new Vector2(0, 0);

        // Act
        $vector->setY(123);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $vector->getY());
        $this->assertEquals('123.0', $vector->getY());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetInvalidElement()
    {
        // Arrange
        $vector = new Vector2(0, 0);

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
        $vector = new Vector2(0, 0);

        // Act
        $vector->setElement(123, 0);

        // Assert
        // ...
    }
}
