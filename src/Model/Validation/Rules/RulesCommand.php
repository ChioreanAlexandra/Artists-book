<?php

namespace MyApp\Model\Validation\Rules;
use MyApp\Model\DomainObjects\User;

interface RulesCommand
{
    public function executeRule();
}