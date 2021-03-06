<?php
/**
 * This file is part of phpmath/vector. (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 * @copyright Copyright (c) 2015-2016 phpmath. (https://github.com/phpmath/)
 * @license https://raw.githubusercontent.com/phpmath/vector/master/LICENSE.md MIT
 */

namespace PHP\Math\Vector;

use InvalidArgumentException;

class VectorUtils
{
    /**
     * Adds the two given vectors to each other.
     *
     * @param Vector $lft The left vector.
     * @param Vector $rgt The right vector.
     * @return Vector
     * @throws InvalidArgumentException Thrown when the given vector is of a different length.
     */
    public static function add(Vector $lft, Vector $rgt)
    {
        if ($lft->getSize() != $rgt->getSize()) {
            throw new InvalidArgumentException('Invalid vectors provided, should be of the same size.');
        }

        $result = new Vector($lft);

        $vectorSize = $lft->getSize();

        for ($i = 0; $i < $vectorSize; ++$i) {
            $result[$i]->add($rgt[$i]);
        }

        return $result;
    }

    /**
     * Calculates the angle between the two given vectors.
     *
     * @param Vector $lft The left vector.
     * @param Vector $rgt The right vector.
     * @return float Returns the angle in radians.
     */
    public static function angleBetween(Vector $lft, Vector $rgt)
    {
        return acos($lft->dotProduct($rgt)->getValue());
    }

    /**
     * Subtracts the two given vectors from each other.
     *
     * @param Vector $lft The left vector.
     * @param Vector $rgt The right vector.
     * @return Vector
     * @throws InvalidArgumentException Thrown when the given vector is of a different length.
     */
    public static function subtract(Vector $lft, Vector $rgt)
    {
        if ($lft->getSize() != $rgt->getSize()) {
            throw new InvalidArgumentException('Invalid vectors provided, should be of the same size.');
        }

        $vectorSize = $lft->getSize();

        $result = new Vector($lft);

        for ($i = 0; $i < $vectorSize; ++$i) {
            $result[$i]->subtract($rgt[$i]);
        }

        return $result;
    }
}
