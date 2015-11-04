<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidAttributesException extends InvalidArgumentException
{
    public function __construct($class)
    {
        parent::__construct("Invalid Attributes for Class: [{$class}]. Must be of type array and non-empty.");
    }
}
