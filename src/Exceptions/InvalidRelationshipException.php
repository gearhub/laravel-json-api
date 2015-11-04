<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidRelationshipException extends InvalidArgumentException
{
    public function __construct($relationship, $class)
    {
        parent::__construct("Invalid Link: [{$relationship}] for Class: [{$class}].");
    }
}
