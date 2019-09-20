<?php

namespace MyApp\Model\Exceptions;


class EmailException extends \Exception
{
    private const EMAIL_EXCEPTION_MESSAGE='The input email is invalid';

    public static function emailException():self
    {
        return new self(self::EMAIL_EXCEPTION_MESSAGE);
    }

}