<?php

namespace MyApp\Model\Validation\Rules;

use MyApp\Model\DomainObjects\User;
use MyApp\Model\Exception\EmailException;
use \MyApp\Model\Validation\Rules\RulesCommand;

class EmailValidator implements RulesCommand
{
    /** @var string */
    private $email;

    public function __construct(string $email)
    {
        $this->email=$email;
    }

    public function executeRule()
    {
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL))
        {
            //throw EmailException::emailException();
        }
    }
}