<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use SonarStudios\LaravelJsonApi\Schema\Link;

class InvalidLinkException extends InvalidArgumentException
{
    public function __construct($class)
    {
        parent::__construct("Invalid Link for Class: [{$class}]. Must be of type: [" . Link::class . "]");
    }
}
