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
 * Thrown when a vector with a w component of zero is projected to three dimensions.
 */
final class ZeroWComponentException extends DomainException implements VectorException
{
}
