<?php

namespace MyApp\Model\Exception;

class EmptyFieldException
{
    private const EMPTY_FIELD_EXCEPTION_MESSAGE='All fields ar mandatory';

    public static function emptyFieldException():self
    {
        return new self(sprintf(self::EMPTY_FIELD_EXCEPTION_MESSAGE));
    }

    public function getMessage():string
    {
        return self::EMPTY_FIELD_EXCEPTION_MESSAGE;
    }
}