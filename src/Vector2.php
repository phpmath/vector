<?php

namespace PHP\Math\Vector;

use InvalidArgumentException;

class Vector2 extends Vector
{
    /**
     * Initializes a new instance of this class.
     *
     * @param float $x The X-component to set.
     * @param float $y The Y-component to set.
     */
    public function __construct($x, $y)
    {
        parent::__construct(array());

        $this->setX($x);
        $this->setY($y);
    }

    /**
     * Gets the X-component from this vector.
     *
     * @return float
     */
    public function getX()
    {
        return $this->getElement(0);
    }

    /**
     * Sets the X-component in this vector.
     *
     * @param float $x The X-component to set
     */
    public function setX($x)
    {
        $this->setElement(0, $x);
    }

    /**
     * Gets the Y-component from this vector.
     *
     * @return float
     */
    public function getY()
    {
        return $this->getElement(1);
    }

    /**
     * Sets the Y-component in this vector.
     *
     * @param float $y The Y-component to set
     */
    public function setY($y)
    {
        $this->setElement(1, $y);
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
        if ($index < 0 || $index >= 2) {
            throw new InvalidArgumentException(sprintf('The index %d is invalid.', $index));
        }
    }
}
