<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

use SonarStudios\LaravelJsonApi\Schema\Resource;

class InvalidResourceAttributesException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Attributes for class: [{${Resource::class}}]. Must be of type array and non-empty.");
    }
}
