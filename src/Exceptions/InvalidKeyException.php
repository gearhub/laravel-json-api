<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidKeyException extends InvalidArgumentException
{
    public function __construct($key, $class, array $allowable_keys = [])
    {
        $allowable_keys_string = '';
        if (!empty($allowable_keys)) {
            $allowable_keys_string = ' Allowable Keys: ' . implode(', ', $allowable_keys);
        }
        parent::__construct("Invalid Key: [{$key}] for Class: [{$class}].{$allowable_keys_string}");
    }
}
