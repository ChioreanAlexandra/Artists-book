<?php

namespace MyApp\Model\Validation\FormValidators;

use MyApp\Model\DomainObjects\User;

class LoginFormValidator
{
    /** @var User */
    private $user;
    /** @var RulesCommand[] */
    private $commands;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

}