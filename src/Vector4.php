<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector;

use PHPMath\Vector\Exception\ZeroWComponentException;

/**
 * An immutable four dimensional vector.
 *
 * The most common use is a point or direction in homogeneous coordinates: a point has w = 1 and a direction has
 * w = 0, so a 4x4 matrix can translate points and leave directions alone.
 */
final readonly class Vector4 extends Vector
{
    public function __construct(float $x, float $y, float $z, float $w)
    {
        parent::__construct([$x, $y, $z, $w]);
    }

    /**
     * Creates a four dimensional vector from a three dimensional one. Use w = 1 for a point and w = 0 for a direction.
     */
    public static function fromVector3(Vector3 $vector, float $w = 1.0): self
    {
        return new self($vector->getX(), $vector->getY(), $vector->getZ(), $w);
    }

    /**
     * Drops the w component. Use project() instead to divide by w first.
     */
    public function toVector3(): Vector3
    {
        return new Vector3($this->getX(), $this->getY(), $this->getZ());
    }

    /**
     * Divides x, y and z by w, which turns homogeneous coordinates into a three dimensional point.
     *
     * @throws ZeroWComponentException Thrown when w is zero, because a direction has no position.
     */
    public function project(): Vector3
    {
        $w = $this->getW();

        if ($w === 0.0) {
            throw new ZeroWComponentException('A vector with w = 0 cannot be projected to three dimensions.');
        }

        return self::createOf(Vector3::class, [$this->getX() / $w, $this->getY() / $w, $this->getZ() / $w]);
    }

    public function getX(): float
    {
        return $this->getElement(0);
    }

    public function withX(float $x): self
    {
        return new self($x, $this->getY(), $this->getZ(), $this->getW());
    }

    public function getY(): float
    {
        return $this->getElement(1);
    }

    public function withY(float $y): self
    {
        return new self($this->getX(), $y, $this->getZ(), $this->getW());
    }

    public function getZ(): float
    {
        return $this->getElement(2);
    }

    public function withZ(float $z): self
    {
        return new self($this->getX(), $this->getY(), $z, $this->getW());
    }

    public function getW(): float
    {
        return $this->getElement(3);
    }

    public function withW(float $w): self
    {
        return new self($this->getX(), $this->getY(), $this->getZ(), $w);
    }
}
