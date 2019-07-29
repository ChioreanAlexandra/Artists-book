<?php

namespace MyApp\Model\Validation\FormValidators;

use MyApp\Model\Exception\EmailException;
use MyApp\Model\Exception\EmptyFieldException;
use MyApp\Model\Validation\Rules\EmailValidator;
use MyApp\Model\Validation\Rules\RulesCommand;

class LoginFormValidator
{
    /** @var array */
    private $userDetails;
    /** @var RulesCommand[] */
    private $commands;
    private const EMAIL='username';

    public function __construct(array $userDetails)
    {
        $this->userDetails=$userDetails;
    }

    public function addToCommandsList(RulesCommand $command)
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
            $emailValidator=new EmailValidator($this->userDetails[self::EMAIL]);
            $this->addToCommandsList($emailValidator);
            $emptyValidator=new EmailValidator($this->userDetails);
            $this->addToCommandsList($emptyValidator);
            $this->runCommands();
        }
        catch (EmptyFieldException $exception)
        {
            $errors[]=$exception->getMessage();
        }
        catch (EmailException $exception)
        {
            $errors[]=$exception->getMessage();
        }
        finally
        {
            return $errors;
        }

    }

}