<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use SonarStudios\LaravelJsonApi\Schema\Relationship;

class InvalidRelationshipException extends InvalidArgumentException
{
    public function __construct($class)
    {
        parent::__construct("Invalid Relationhip for Class: [{$class}]. Must be of type [" . Relationship::class . "].");
    }
}
