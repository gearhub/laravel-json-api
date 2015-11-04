<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidIdException extends InvalidArgumentException
{
    public function __construct($class)
    {
        parent::__construct("Invalid Id for Class: [{$class}]. Must be of type integer or string.");
    }
}
