<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception;

use SonarStudios\LaravelJsonApi\Schema\ResourceIdentifier;

class InvalidResourceIdentifierIdException extends InvalidIdException
{
    public function __construct($id)
    {
        parent::__construct($id, ResourceIdentifier::class);
    }
}
