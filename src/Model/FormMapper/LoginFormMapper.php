<?php

namespace MyApp\Model\FormMapper;

use \MyApp\Model\DomainObjects\User;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;

class LoginFormMapper
{
    /** @var Request  */
    private $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function createUserFromLoginForm():?User
    {
        if($this->request->getPost())
        {
            return new User($this->request->getPost()[getEmailField()], $this->request->getPost()[getPasswordField()], CRYPT_SHA512);
        }
        return null;
    }

}