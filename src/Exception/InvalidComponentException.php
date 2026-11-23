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
 * Thrown when a component is not an int or a float, or is NAN or infinite.
 */
final class InvalidComponentException extends InvalidArgumentException implements VectorException
{
}
