<?php

namespace MyApp\Model\Validation;

use MyApp\Model\Validation\Rules\RulesCommand;

class EmptyValidator implements RulesCommand
{
    /** @var array */
    private $inputValues;

    public function executeRule(): bool
    {
        foreach($this->inputValues as $item)
        {
            if(empty($item))
                return false;
        }
        return true;
    }
}