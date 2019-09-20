<?php

namespace MyApp\Model\Validation\Rules;

use MyApp\Model\Exceptions\EmptyFieldException;

class EmptyValidator implements RulesCommand
{
    /** @var array */
    private $inputValues;

    /**
     * EmptyValidator constructor.
     * @param array $inputValues
     */
    public function __construct(array $inputValues)
    {
        $this->inputValues = $inputValues;
    }


    public function executeRule()
    {
        foreach ($this->inputValues as $item) {
            if (empty($item))
               throw EmptyFieldException::emptyFieldException();
        }
    }
}