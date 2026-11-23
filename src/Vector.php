<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use PHPMath\Vector\Exception\EmptyVectorException;
use PHPMath\Vector\Exception\IndexOutOfRangeException;
use PHPMath\Vector\Exception\InvalidComponentException;
use PHPMath\Vector\Exception\SizeMismatchException;
use PHPMath\Vector\Exception\ZeroLengthException;
use ReflectionClass;
use ReflectionProperty;
use Stringable;
use Traversable;

use function abs;
use function array_map;
use function array_values;
use function atan2;
use function count;
use function get_debug_type;
use function implode;
use function is_finite;
use function is_float;
use function is_int;
use function is_nan;
use function max;
use function min;
use function number_format;
use function rtrim;
use function sprintf;
use function sqrt;
use function str_contains;

/**
 * An immutable vector of one or more float components. Operations never change the
 * instance they are called on, they return a new instance.
 *
 * @implements IteratorAggregate<int, float>
 */
readonly class Vector implements Countable, IteratorAggregate, Stringable
{
    /** @var list<float> */
    private array $components;

    /**
     * @param array<int|string, mixed> $components The components of the vector, ints or finite floats.
     *
     * @throws EmptyVectorException Thrown when no components are given.
     * @throws InvalidComponentException Thrown when a component is not an int or float, or is NAN or infinite.
     */
    public function __construct(array $components)
    {
        if ($components === []) {
            throw new EmptyVectorException('A vector needs at least one component.');
        }

        $result = [];

        foreach ($components as $key => $value) {
            if (! is_int($value) && ! is_float($value)) {
                throw new InvalidComponentException(
                    sprintf('The component %s must be an int or a float, %s given.', $key, get_debug_type($value)),
                );
            }

            self::assertFinite((float) $value, (string) $key);

            $result[] = (float) $value + 0.0;
        }

        $this->components = $result;
    }

    public function __toString(): string
    {
        return '[' . implode(', ', array_map(self::formatNumber(...), $this->components)) . ']';
    }

    public function add(self $vector): static
    {
        $this->assertSameSize($vector);

        $result = [];

        foreach ($this->components as $index => $value) {
            $result[] = $value + $vector->components[$index];
        }

        return $this->create($result);
    }

    public function subtract(self $vector): static
    {
        $this->assertSameSize($vector);

        $result = [];

        foreach ($this->components as $index => $value) {
            $result[] = $value - $vector->components[$index];
        }

        return $this->create($result);
    }

    public function scale(float $scale): static
    {
        return $this->create(array_map(static fn (float $value): float => $value * $scale, $this->components));
    }

    /**
     * Negates the vector. The result has the same magnitude, but the opposite direction.
     */
    public function negate(): static
    {
        return $this->scale(-1.0);
    }

    /**
     * Normalizes the vector to a unit vector. The components are divided by the largest absolute
     * component first, so very large and very small vectors do not overflow or underflow.
     *
     * @throws InvalidComponentException Thrown when a component is NAN or infinite.
     * @throws ZeroLengthException Thrown when the vector has a length of zero.
     */
    public function normalize(): static
    {
        if (! $this->isFinite()) {
            throw new InvalidComponentException('A vector with non-finite components cannot be normalized.');
        }

        $largest = max(array_map(abs(...), $this->components));

        if ($largest === 0.0) {
            throw new ZeroLengthException('A vector with a length of zero cannot be normalized.');
        }

        $scaled = array_map(static fn (float $value): float => $value / $largest, $this->components);

        $sum = 0.0;

        foreach ($scaled as $value) {
            $sum += $value * $value;
        }

        $length = sqrt($sum);

        return $this->create(array_map(static fn (float $value): float => $value / $length, $scaled));
    }

    /** @throws SizeMismatchException Thrown when the given vector is of a different size. */
    public function dotProduct(self $vector): float
    {
        $this->assertSameSize($vector);

        $result = 0.0;

        foreach ($this->components as $index => $value) {
            $result += $value * $vector->components[$index];
        }

        return $result;
    }

    /**
     * Calculates the angle between this vector and the given vector, with the numerically stable
     * formula 2 * atan2(|| |b| * a - |a| * b ||, || |b| * a + |a| * b ||).
     *
     * @return float The angle in radians.
     *
     * @throws SizeMismatchException Thrown when the vectors differ in size.
     * @throws ZeroLengthException Thrown when one of the vectors has a length of zero.
     */
    public function angleBetween(self $vector): float
    {
        $this->assertSameSize($vector);

        $lengthA = $this->getLength();
        $lengthB = $vector->getLength();

        if ($lengthA === 0.0 || $lengthB === 0.0) {
            throw new ZeroLengthException('The angle with a vector of length zero is undefined.');
        }

        $a = $this->scale($lengthB);
        $b = $vector->scale($lengthA);

        return 2.0 * atan2($a->subtract($b)->getLength(), $a->add($b)->getLength());
    }

    public function getLength(): float
    {
        return sqrt($this->getLengthSquared());
    }

    public function getLengthSquared(): float
    {
        return $this->dotProduct($this);
    }

    /** @throws IndexOutOfRangeException Thrown when the index does not exist. */
    public function getElement(int $index): float
    {
        return $this->components[$index] ?? throw new IndexOutOfRangeException(
            sprintf('The index %d is invalid.', $index),
        );
    }

    /**
     * Returns a copy of this vector with the element at the given index replaced.
     *
     * @throws IndexOutOfRangeException Thrown when the index does not exist.
     * @throws InvalidComponentException Thrown when the value is NAN or infinite.
     */
    public function withElement(int $index, float $value): static
    {
        $this->getElement($index);
        self::assertFinite($value, (string) $index);

        $components = $this->components;
        $components[$index] = $value;
        $components = array_values($components);

        return $this->create($components);
    }

    /**
     * Tells whether all components are finite. Only the results of operations can be non-finite,
     * for example after an overflow, because the constructor rejects NAN and infinite values.
     */
    public function isFinite(): bool
    {
        foreach ($this->components as $value) {
            if (! is_finite($value)) {
                return false;
            }
        }

        return true;
    }

    public function getSize(): int
    {
        return count($this->components);
    }

    public function count(): int
    {
        return count($this->components);
    }

    public function getMaximumValue(): float
    {
        return max($this->components);
    }

    public function getMinimumValue(): float
    {
        return min($this->components);
    }

    /** @return list<float> */
    public function toArray(): array
    {
        return $this->components;
    }

    public function toString(): string
    {
        return (string) $this;
    }

    /** @return Traversable<int, float> */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->components);
    }

    /**
     * Creates a vector of the same type from the given components, without validating them,
     * because the results of operations may be non-finite. Negative zero is normalised to zero.
     *
     * @param list<float> $components
     */
    protected function create(array $components): static
    {
        return self::createOf(static::class, $components);
    }

    /**
     * Creates a vector of the given class, with the same rules as create().
     *
     * @param class-string<T> $class
     * @param list<float> $components
     *
     * @return T
     *
     * @template T of self
     */
    protected static function createOf(string $class, array $components): self
    {
        $vector = (new ReflectionClass($class))->newInstanceWithoutConstructor();
        $values = array_map(static fn (float $value): float => $value + 0.0, $components);

        (new ReflectionProperty(self::class, 'components'))
            ->setRawValueWithoutLazyInitialization($vector, $values);

        return $vector;
    }

    private static function assertFinite(float $value, string $position): void
    {
        if (! is_finite($value)) {
            throw new InvalidComponentException(sprintf('The component %s must be finite.', $position));
        }
    }

    private static function formatNumber(float $value): string
    {
        if (! is_finite($value)) {
            return is_nan($value) ? 'NAN' : ($value > 0.0 ? 'INF' : '-INF');
        }

        $text = number_format($value, 14, '.', '');

        if (str_contains($text, '.')) {
            $text = rtrim(rtrim($text, '0'), '.');
        }

        return $text === '-0' ? '0' : $text;
    }

    private function assertSameSize(self $vector): void
    {
        if ($this->getSize() !== $vector->getSize()) {
            throw new SizeMismatchException('Invalid vector provided, should be of the same size.');
        }
    }
}
