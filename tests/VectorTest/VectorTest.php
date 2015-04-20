<?php

namespace PHP\Math\VectorTest;

use PHP\Math\Vector\Vector;
use PHPUnit_Framework_TestCase;

class VectorTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        // Arrange
        $vector1 = new Vector(array(1, 2, 3));
        $vector2 = new Vector(array(1, 2, 3));

        // Act
        $vector1->add($vector2);

        // Assert
        $this->assertEquals('[2.0000000000, 4.0000000000, 6.0000000000]', (string)$vector1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddInvalid()
    {
        // Arrange
        $vector1 = new Vector(array(1, 2, 3));
        $vector2 = new Vector(array(1, 2, 3, 4));

        // Act
        $vector1->add($vector2);

        // Assert
        // ...
    }

    public function testConjugate()
    {
        // Arrange
        $vector = new Vector(array(1, 2, 3));

        // Act
        $vector->conjugate();

        // Assert
        $this->assertEquals('[-1.0000000000, -2.0000000000, -3.0000000000]', (string)$vector);
    }

    public function testDotProduct()
    {
        // Arrange
        $vector1 = new Vector(array(4, 5, 6));
        $vector2 = new Vector(array(4, 5, 6));

        // Act
        $dotProduct = $vector1->dotProduct($vector2);

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $dotProduct);
        $this->assertEquals('77.0000000000', $dotProduct);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDotProductWithInvalidSizeVector()
    {
        // Arrange
        $vector1 = new Vector(array(4, 5, 6));
        $vector2 = new Vector(array(4, 5, 6, 7));

        // Act
        $vector1->dotProduct($vector2);

        // Assert
        // ...
    }

    public function testGetLength()
    {
        // Arrange
        $vector = new Vector(array(3));

        // Act
        $result = $vector->getLength();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $result);
        $this->assertEquals('3.0', $result);
    }

    public function testGetLengthSquared()
    {
        // Arrange
        $vector = new Vector(array(3));

        // Act
        $result = $vector->getLengthSquared();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $result);
        $this->assertEquals('9.0', $result);
    }

    public function testGetMagnitude()
    {
        // Arrange
        $vector = new Vector(array(3));

        // Act
        $result = $vector->getMagnitude();

        // Assert
        $this->assertInstanceOf('PHP\Math\BigNumber\BigNumber', $result);
        $this->assertEquals('3.0', $result);
    }

    public function testNegate()
    {
        // Arrange
        $vector = new Vector(array(1, 2, 3));

        // Act
        $vector->negate();

        // Assert
        $this->assertEquals('[-1.0000000000, -2.0000000000, -3.0000000000]', (string)$vector);
    }

    public function testNormalize()
    {
        // Arrange
        $vector = new Vector(array(3));

        // Act
        $vector->normalize();

        // Assert
        $this->assertEquals('1.0', (string)$vector->getLength());
    }

    public function testReverse()
    {
        // Arrange
        $vector = new Vector(array(1, 2, 3));

        // Act
        $vector->reverse();

        // Assert
        $this->assertEquals('[-1.0000000000, -2.0000000000, -3.0000000000]', (string)$vector);
    }

    public function testScale()
    {
        // Arrange
        $vector = new Vector(array(4, 5, 6));

        // Act
        $vector->scale(2);

        // Assert
        $this->assertEquals('[8.0000000000, 10.0000000000, 12.0000000000]', (string)$vector);
    }

    public function testSubtract()
    {
        // Arrange
        $vector1 = new Vector(array(1, 2, 3));
        $vector2 = new Vector(array(1, 2, 3));

        // Act
        $vector1->subtract($vector2);

        // Assert
        $this->assertEquals('[0.0000000000, 0.0000000000, 0.0000000000]', (string)$vector1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSubtractInvalid()
    {
        // Arrange
        $vector1 = new Vector(array(1, 2, 3));
        $vector2 = new Vector(array(1, 2, 3, 4));

        // Act
        $vector1->subtract($vector2);

        // Assert
        // ...
    }
}
