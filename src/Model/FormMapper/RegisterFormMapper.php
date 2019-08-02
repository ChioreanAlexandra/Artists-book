<?php


namespace MyApp\Model\FormMapper;


use MyApp\Model\DomainObjects\User;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;

class RegisterFormMapper
{
    /** @var Request  */
    private $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    /**
     * @return User|null
     */
    public function createUserFromRegisterForm():?User
    {
        if($this->request->getPost())
        {
            return new User($this->request->getPost()[UserField::getEmailField()],$this->request->getPost()[UserField::getPasswordField()],$this->request->getPost()[UserField::getNameField()]);
        }
        return null;
    }
}