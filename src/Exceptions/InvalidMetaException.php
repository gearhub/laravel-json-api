<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidMetaException extends InvalidArgumentException
{
    public function __construct($class)
    {
        parent::__construct("Invalid Meta for class: [{$class}]. Must be of type array or null.");
    }
}
