<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Exception;

use OutOfRangeException;

/**
 * Thrown when an element is requested at an index that does not exist.
 */
final class IndexOutOfRangeException extends OutOfRangeException implements VectorException
{
}
