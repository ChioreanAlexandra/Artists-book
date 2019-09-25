<?php


namespace MyApp\Model\Exceptions;


class InvalidUsername extends \Exception
{
    const USERNAME_INVALID_NAME_MESSAGE = 'Username should only contain letters, numbers and @,. ,_ ';

    public static function invalidUsernameException(): self
    {
        return new self(self::USERNAME_INVALID_NAME_MESSAGE);
    }

}