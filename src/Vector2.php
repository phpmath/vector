<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector;

/**
 * An immutable two dimensional vector.
 */
final readonly class Vector2 extends Vector
{
    public function __construct(float $x, float $y)
    {
        parent::__construct([$x, $y]);
    }

    public function getX(): float
    {
        return $this->getElement(0);
    }

    public function withX(float $x): self
    {
        return new self($x, $this->getY());
    }

    public function getY(): float
    {
        return $this->getElement(1);
    }

    public function withY(float $y): self
    {
        return new self($this->getX(), $y);
    }
}
