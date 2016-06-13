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

class VectorUtilsAngleBetweenTest extends PHPUnit_Framework_TestCase
{
    public function testAngleBetween()
    {
        // Arrange
        $vector1 = new Vector(array(1, 0, 0));
        $vector2 = new Vector(array(0, 1, 0));

        // Act
        $angle = VectorUtils::angleBetween($vector1, $vector2);

        // Assert
        $this->assertInternalType('float', $angle);
        $this->assertEquals('1.5707963267948966', $angle);
    }
}
