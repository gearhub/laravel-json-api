<?php

namespace SonarStudios\LaravelJsonApi\Exceptions;

use Exception as BaseException;

class Exception extends BaseException
{
    public function __construct($value)
    {
        parent::__construct($value);
    }
}
