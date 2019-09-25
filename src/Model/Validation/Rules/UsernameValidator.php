<?php


namespace MyApp\Model\Validation\Rules;


use http\Exception\InvalidArgumentException;
use MyApp\Model\Exceptions\InvalidUsername;
use MyApp\Model\Exceptions\LengthException;

class UsernameValidator implements RulesCommand
{

    /** @var string */
    public $username;

    /**
     * PasswordValidator constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function executeRule()
    {
        if (strlen($this->username)<8)
        {
            throw LengthException::usernameLengthException();
        }
        if (!preg_match('/[\w]+/',$this->username))
        {
            throw InvalidUsername::invalidUsernameException();
        }

    }

}