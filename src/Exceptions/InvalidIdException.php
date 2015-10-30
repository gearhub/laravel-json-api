<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

class InvalidIdException extends Exception
{
    public function __construct($id, $class)
    {
        parent::__construct("Invalid Id: [{$id}] for class: [{$class}]. Must be of type integer or string.");
    }
}
