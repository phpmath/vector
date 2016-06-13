<?php
/**
 * This file is part of phpmath/vector. (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 * @copyright Copyright (c) 2015-2016 phpmath. (https://github.com/phpmath/)
 * @license https://raw.githubusercontent.com/phpmath/vector/master/LICENSE.md MIT
 */

namespace PHP\Math\VectorTest;

use PHP\Math\Vector\Vector;
use PHP\Math\Vector\VectorUtils;
use PHPUnit_Framework_TestCase;

class VectorUtiilsSubtractTest extends PHPUnit_Framework_TestCase
{
    public function testSubtract()
    {
        // Arrange
        $lft = new Vector(array(10, 20, 30));
        $rgt = new Vector(array(5, 5, 5));

        // Act
        $result = VectorUtils::subtract($lft, $rgt);

        // Assert
        $this->assertInstanceOf('PHP\Math\Vector\Vector', $result);
        $this->assertEquals('[5.0000000000, 15.0000000000, 25.0000000000]', (string)$result);
        $this->assertEquals('[10.0000000000, 20.0000000000, 30.0000000000]', (string)$lft);
        $this->assertEquals('[5.0000000000, 5.0000000000, 5.0000000000]', (string)$rgt);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSubtractInvalid()
    {
        // Arrange
        $lft = new Vector(array(10, 20, 30));
        $rgt = new Vector(array(5, 5, 5, 5));

        // Act
        VectorUtils::subtract($lft, $rgt);

        // Assert
        // ...
    }
}
