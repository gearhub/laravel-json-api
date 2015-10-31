<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidKeyException extends Exception
{
    public function __construct($key, $class)
    {
        parent::__construct("Invalid key: [{$key}] for class: [{$class}].");
    }
}
