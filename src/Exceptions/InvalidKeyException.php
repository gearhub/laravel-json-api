<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

class InvalidKeyException extends Exception
{
    public function __construct($key, $class)
    {
        parent::__construct("Invalid key: [{$key}] for class: [{$class}].");
    }
}
