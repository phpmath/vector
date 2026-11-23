<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector;

/**
 * An immutable three dimensional vector.
 */
final readonly class Vector3 extends Vector
{
    public function __construct(float $x, float $y, float $z)
    {
        parent::__construct([$x, $y, $z]);
    }

    public function crossProduct(self $vector): self
    {
        return $this->create([
            $this->getY() * $vector->getZ() - $this->getZ() * $vector->getY(),
            $this->getZ() * $vector->getX() - $this->getX() * $vector->getZ(),
            $this->getX() * $vector->getY() - $this->getY() * $vector->getX(),
        ]);
    }

    public function getX(): float
    {
        return $this->getElement(0);
    }

    public function withX(float $x): self
    {
        return new self($x, $this->getY(), $this->getZ());
    }

    public function getY(): float
    {
        return $this->getElement(1);
    }

    public function withY(float $y): self
    {
        return new self($this->getX(), $y, $this->getZ());
    }

    public function getZ(): float
    {
        return $this->getElement(2);
    }

    public function withZ(float $z): self
    {
        return new self($this->getX(), $this->getY(), $z);
    }
}
