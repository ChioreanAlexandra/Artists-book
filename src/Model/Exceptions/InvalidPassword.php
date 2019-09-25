<?php


namespace MyApp\Model\Exceptions;


class InvalidPassword extends \Exception
{
    const PASSWORD_INVALID_NAME_MESSAGE = 'Password should contain at least one upper case letter, a number and a special character';

    public static function invalidPasswordException(): self
    {
        return new self(self::PASSWORD_INVALID_NAME_MESSAGE);
    }
}