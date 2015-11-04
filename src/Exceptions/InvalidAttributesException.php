<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidAttributesException extends InvalidArgumentException
{
    public function __construct($attributes, $class)
    {
        parent::__construct("Invalid Attributes: [{$attributes}] for Class: [{$class}]. Must be of type array and non-empty.");
    }
}
