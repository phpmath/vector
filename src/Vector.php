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
use PHP\Math\BigNumber\BigNumber;

class Vector extends Tuple
{
    /**
     * Adds the given vector to this vector.
     *
     * @param Vector $vector The vector to add.
     * @return Vector
     * @throws InvalidArgumentException Thrown when the given vector is of a different length.
     */
    public function add(Vector $vector)
    {
        if ($this->getSize() != $vector->getSize()) {
            throw new InvalidArgumentException('Invalid vector provided, should be of the same size.');
        }

        foreach ($this as $index => $value) {
            $this[$index]->add($vector[$index]);
        }

        return $this;
    }

    /**
     * Conjugates the vector. This is an alias of reverse().
     */
    public function conjugate()
    {
        return $this->reverse();
    }

    /**
     * Calculates the dot product between this vector and the given vector.
     *
     * @param Vector $vector The vector to calculate thet dot product with.
     * @return float
     */
    public function dotProduct(Vector $vector)
    {
        if ($this->getSize() !== $vector->getSize()) {
            throw new InvalidArgumentException('Invalid vector provided. The size should be the same.');
        }

        $result = new BigNumber();

        $vectorSize = $this->getSize();

        for ($i = 0; $i < $vectorSize; ++$i) {
            $value = new BigNumber($this[$i]);
            $value->multiply($vector[$i]);

            $result->add($value);
        }

        return $result;
    }

	/**
	 * Gets the length of the vector.
	 *
	 * @return float
	 */
    public function getLength()
    {
        return $this->getLengthSquared()->sqrt();
    }

	/**
	 * Gets the square of the vector's length.
	 *
	 * @return float
	 */
    public function getLengthSquared()
    {
        $result = new BigNumber();

        $vectorSize = $this->getSize();

        for ($i = 0; $i < $vectorSize; ++$i) {
            $pow = new BigNumber($this->getElement($i));
            $pow->pow(2);

            $result->add($pow);
        }

        return $result;
    }

    /**
     * Gets the magnitude of the vector. This is an alias of getLength().
     *
     * @return float
     */
    public function getMagnitude()
    {
        return $this->getLength();
    }

    /**
     * Negates this vector. The vector has the same magnitude as before, but its direction is now opposite.
     *
     * @return Vector
     */
    public function negate()
    {
        $vectorSize = $this->getSize();

        for ($i = 0; $i < $vectorSize; ++$i) {
            $this->getElement($i)->multiply(-1);
        }

        return $this;
    }

    /**
     * Normalizes the vector, making sure the length of the vector is 1 (a unit vector).
     *
     * @return Vector
     */
    public function normalize()
    {
        $length = $this->getLength();

        $vectorSize = $this->getSize();

        for ($i = 0; $i < $vectorSize; ++$i) {
            $this->getElement($i)->divide($length);
        }

        return $this;
    }

    /**
     * Reverses the sign of the components. This is an alias of negate.
     *
     * @return Vector
     */
    public function reverse()
    {
        return $this->negate();
    }

    /**
     * Scales the vector.
     *
     * @param float $scale The scale factor.
     * @return Vector
     */
    public function scale($scale)
    {
        foreach ($this as $key => $value) {
            $this[$key]->multiply($scale);
        }

        return $this;
    }

    /**
     * Subtracts the given vector from this vector.
     *
     * @param Vector $vector The vector to sutbract.
     * @return Vector
     * @throws InvalidArgumentException Thrown when the given vector is of a different length.
     */
    public function subtract(Vector $vector)
    {
        if ($this->getSize() != $vector->getSize()) {
            throw new InvalidArgumentException('Invalid vector provided, should be of the same size.');
        }

        foreach ($this as $index => $value) {
            $this[$index]->subtract($vector[$index]);
        }

        return $this;
    }
}
