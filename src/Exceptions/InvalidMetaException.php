<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

class InvalidMetaException extends InvalidArgumentException
{
    public function __construct($meta, $class)
    {
        parent::__construct("Invalid Meta: [{$meta}] for class: [{$class}].");
    }
}
