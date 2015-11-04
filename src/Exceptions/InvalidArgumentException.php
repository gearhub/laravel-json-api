<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use SonarStudios\LaravelJsonApi\Contracts\Exceptions\Exception as ExceptionContract;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionContract
{
    //
}
