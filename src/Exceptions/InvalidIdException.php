<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidIdException extends InvalidArgumentException
{
    public function __construct($id, $class)
    {
        parent::__construct("Invalid Id: [{$id}] for Class: [{$class}]. Must be of type integer or string.");
    }
}
