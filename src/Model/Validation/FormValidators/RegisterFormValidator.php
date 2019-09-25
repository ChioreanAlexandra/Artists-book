<?php

namespace MyApp\Model\Validation\FormValidators;

use MyApp\Model\Exceptions\EmailException;
use MyApp\Model\Exceptions\EmptyFieldException;
use MyApp\Model\Exceptions\InvalidPassword;
use MyApp\Model\Exceptions\InvalidUsername;
use MyApp\Model\Exceptions\LengthException;
use MyApp\Model\Validation\Rules\EmailValidator;
use MyApp\Model\Validation\Rules\PasswordValidator;
use MyApp\Model\Validation\Rules\RulesCommand;
use MyApp\Model\Validation\Rules\EmptyValidator;
use MyApp\Model\Validation\Rules\UsernameValidator;

class RegisterFormValidator
{
    /** @var array */
    private $userDetails;
    /** @var RulesCommand[] */
    private $commands;

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
        try {
            $emptyValidator = new EmptyValidator($this->userDetails);
            $this->addToCommandsList($emptyValidator);

            $usernameValidator = new UsernameValidator($this->userDetails['name']);
            $this->addToCommandsList($usernameValidator);

            $emailValidator = new EmailValidator($this->userDetails['email']);
            $this->addToCommandsList($emailValidator);

            $passwordValidator = new PasswordValidator($this->userDetails['password']);
            var_dump($passwordValidator);
            $this->addToCommandsList($passwordValidator);

            $this->runCommands();
        }
        catch (EmptyFieldException $exception)
        {
            $errors['emptyFields']=$exception->getMessage();
        }
        catch (EmailException $exception)
        {
            $errors['email']=$exception->getMessage();
        }
        catch (InvalidUsername $exception)
        {
            $errors['username']=$exception->getMessage();
        }
        catch (InvalidPassword $exception)
        {
            $errors['password']=$exception->getMessage();
        }
        catch (LengthException $exception)
        {
            $errors['length']=$exception->getMessage();
        }
        finally
        {
            return $errors;
        }

    }
}