<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

use SonarStudios\LaravelJsonApi\Schema\Link;

class InvalidLinkKeyException extends InvalidKeyException
{
    public function __construct($key)
    {
        parent::__construct($key, Link::class);
    }
}
