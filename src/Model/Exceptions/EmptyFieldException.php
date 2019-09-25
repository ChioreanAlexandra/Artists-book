<?php

namespace MyApp\Model\Exceptions;

class EmptyFieldException extends \Exception
{
    private const EMPTY_FIELD_EXCEPTION_MESSAGE='All fields are mandatory';

    public static function emptyFieldException():self
    {
        return new self(sprintf(self::EMPTY_FIELD_EXCEPTION_MESSAGE));
    }

}