<?php


namespace MyApp\Model\Exceptions;


class LengthException extends \Exception
{
    const USERNAME_LENGTH_EXCEPTION_MESSAGE='Username must have at least 12 characters';
    const PASSWORD_LENGTH_EXCEPTION_MESSAGE='Password must have at least 8 characters';

    public static function usernameLengthException():self
    {
        return new self(self::USERNAME_LENGTH_EXCEPTION_MESSAGE);
    }
    public static function passwordLengthException():self
    {
        return new self(self::PASSWORD_LENGTH_EXCEPTION_MESSAGE);
    }
}