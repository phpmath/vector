<?php

/**
 * phpmath / vector (https://github.com/phpmath/vector)
 *
 * @link https://github.com/phpmath/vector for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\Vector\Exception;

use DomainException;

/**
 * Thrown when an operation is undefined for a vector with a length of zero.
 */
final class ZeroLengthException extends DomainException implements VectorException
{
}
