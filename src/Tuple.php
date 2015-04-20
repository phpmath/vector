<?php

namespace PHP\Math\Vector;

use ArrayObject;
use InvalidArgumentException;
use Iterator;
use PHP\Math\BigNumber\BigNumber;

class Tuple extends ArrayObject
{
    /**
     * Initializes a new instance of this class.
     *
     * @param array|Iterator $components The components to set.
     */
    public function __construct($components = array())
    {
        parent::__construct(array());

        $index = 0;

        foreach ($components as $component) {
            $this->setElement($index++, $component);
        }
    }

    /**
     * Adds an element to the tuple.
     *
     * @param float|BigNumber $value The value to add.
     * @return int Returns the index of the element that was added.
     */
    public function addElement($value)
    {
        $index = $this->getSize();

        $this->setElement($index, $value);

        return $index;
    }

    /**
     * Gets the element located at the given index.
     *
     * @param int $index The index of the element to get.
     * @return BigNumber
     */
    public function getElement($index)
    {
        $this->validateIndex($index, true);

        return $this[$index];
    }

    /**
     * Removes the element located at the given index.
     *
     * @param int $index The index of the element to remove.
     * @return null|BigNumber Returns the element that is removed or null if nothing was removed.
     */
    public function removeElementIndex($index)
    {
        if (array_key_exists($index, $this)) {
            $element = $this[$index];

            unset($this[$index]);
        } else {
            $element = null;
        }

        return $element;
    }

    /**
     * Removes the given element.
     *
     * @param float|BigNumber $element The element to remove.
     * @return bool Returns true when the element was removed; false otherwise.
     */
    public function removeElement($element)
    {
        $bigNumber = new BigNumber($element);
        $key = array_search($bigNumber, $this->getArrayCopy(), false);

        if ($key === false) {
            return false;
        }

        unset($this[$key]);

        return true;
    }

    /**
     * Sets the element located at the given index.
     *
     * @param int $index The index of the element to get.
     * @param float|BigNumber $value The value to set.
     */
    public function setElement($index, $value)
    {
        $this->validateIndex($index, false);

        $bigNumber = new BigNumber($value);

        for ($i = count($this); $i < $index; ++$i) {
            $this->setElement($i, new BigNumber(0));
        }

        $this[$index] = $bigNumber;
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
        if ($index < 0) {
            throw new InvalidArgumentException(sprintf('The index %d is invalid.', $index));
        }

        if ($indexShouldExists && !array_key_exists($index, $this)) {
            throw new InvalidArgumentException(sprintf('The index %d is invalid.', $index));
        }
    }

    /**
     * Gets the amount of components in this tuple.
     *
     * @return int
     */
    public function getSize()
    {
        return count($this);
    }

    /**
     * Gets the maximum value in the tuple.
     *
     * @return BigNumber
     */
    public function getMaximumValue()
    {
        return max($this->getArrayCopy());
    }

    /**
     * Gets the minimum value in the tuple.
     *
     * @return BigNumber
     */
    public function getMinimumValue()
    {
        return min($this->getArrayCopy());
    }

    /**
     * Converts this tuple to a string.
     *
     * @return string
     */
    public function toString()
    {
        return '[' . implode(', ', $this->getArrayCopy()) . ']';
    }

    /**
     * Converts this tuple to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
