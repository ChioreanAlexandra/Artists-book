<?php

namespace MyApp\Model\Validation\FormValidators;

use MyApp\Model\Exceptions\EmailException;
use MyApp\Model\Exceptions\EmptyFieldException;
use MyApp\Model\Validation\Rules\EmptyValidator;
use MyApp\Model\Validation\Rules\EmailValidator;
use MyApp\Model\Validation\Rules\RulesCommand;

class LoginFormValidator
{
    /** @var array */
    private $userDetails;
    /** @var RulesCommand[] */
    private $commands;
    const EMAIL='email';

    public function __construct(array $userDetails)
    {
        $this->userDetails=$userDetails;
    }

    private function addToCommandsList(RulesCommand $command)
    {
        $this->commands[]=$command;
    }

    private function runCommands()
    {
        foreach ($this->commands as $rule)
        {
            $rule->executeRule();
        }
    }

    public function validate():array
    {
        $errors=[];
        try
        {
            $emptyValidator=new EmptyValidator($this->userDetails);
            $this->addToCommandsList($emptyValidator);
            $emailValidator=new EmailValidator($this->userDetails[self::EMAIL]);
            $this->addToCommandsList($emailValidator);
            $this->runCommands();
        }
        catch (EmailException $exception)
        {
            $errors['email']=$exception->getMessage();
        }
        catch (EmptyFieldException $exception)
        {
            $errors['emptyFields']=$exception->getMessage();
        }
        finally
        {
            return $errors;
        }

    }

}