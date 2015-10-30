<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

use SonarStudios\LaravelJsonApi\Schema\Resource;

class InvalidResourceIdException extends InvalidIdException
{
    public function __construct($id)
    {
        parent::__construct($id, Resource::class);
    }
}
