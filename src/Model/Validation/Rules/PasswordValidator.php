<?php


namespace MyApp\Model\Validation\Rules;


use MyApp\Model\Exceptions\InvalidPassword;
use MyApp\Model\Exceptions\LengthException;

class PasswordValidator implements RulesCommand
{
    /** @var string */
    private $password;

    /**
     * PasswordValidator constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function executeRule()
    {
        var_dump($this->password);
        if (strlen($this->password) < 8) {
            var_dump('pass1');
            throw LengthException::passwordLengthException();
        }
        if (!preg_match('/[A-Z]/',$this->password)) {
            var_dump('pass2');
            throw InvalidPassword::invalidPasswordException();
        }
        if (!preg_match('/\d/', $this->password)) {
            var_dump('pass3');
            throw InvalidPassword::invalidPasswordException();
        }
        if (!preg_match('/[^\w\d]/', $this->password)) {
            var_dump('pass4');
            throw InvalidPassword::invalidPasswordException();
        }
    }
}