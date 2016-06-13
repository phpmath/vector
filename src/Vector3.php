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
use PHP\Math\BigNumber\Utils as BigNumberUtils;

class Vector3 extends Vector2
{
    /**
     * Initializes a new instance of this class.
     *
     * @param float $x The X-component to set.
     * @param float $y The Y-component to set.
     * @param float $z The Z-component to set.
     */
    public function __construct($x, $y, $z)
    {
        parent::__construct($x, $y);

        $this->setZ($z);
    }

    /**
     * Calculates the cross product between this vector and the given vector.
     *
     * @param Vector3 $vector The vector to calculate with.
     * @return Vector3
     */
    public function crossProduct(Vector3 $vector)
    {
        $x = BigNumberUtils::multiply($this->getY(), $vector->getZ());
        $x->subtract(BigNumberUtils::multiply($this->getZ(), $vector->getY()));

        $y = BigNumberUtils::multiply($this->getZ(), $vector->getX());
        $y->subtract(BigNumberUtils::multiply($this->getX(), $vector->getZ()));

        $z = BigNumberUtils::multiply($this->getX(), $vector->getY());
        $z->subtract(BigNumberUtils::multiply($this->getY(), $vector->getX()));

        return new Vector3($x, $y, $z);
    }

    /**
     * Gets the X-component from this vector.
     *
     * @return float
     */
    public function getZ()
    {
        return $this->getElement(2);
    }

    /**
     * Sets the Z-component in this vector.
     *
     * @param float $z The Z-component to set
     */
    public function setZ($z)
    {
        $this->setElement(2, $z);
    }

    /**
     * Validates the index.
     *
     * @param int $index The index to validate.
     * @param bool $indexShouldExists Whether or not the index should exists.
     * @throws InvalidArgumentException Thrown when the index is invalid.
     */
    protected function validateIndex($index, $indexShouldExists)
    {
        if ($index < 0 || $index >= 3) {
            throw new InvalidArgumentException(sprintf('The index %d is invalid.', $index));
        }
    }
}
