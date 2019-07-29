<?php

namespace MyApp\Model\Exception;

class EmailException extends Exception
{
    private const EMAIL_EXCEPTION_MESSAGE='The input email is invalid';

    public static function emailException():self
    {
        return new self(sprintf(self::EMAIL_EXCEPTION_MESSAGE));
    }

    public function getMessage():string
    {
        return self::EMAIL_EXCEPTION_MESSAGE;
    }
}