<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Exception;

use InvalidArgumentException;

/**
 * Thrown when a vector is created without components.
 */
final class EmptyVectorException extends InvalidArgumentException implements VectorException
{
}
