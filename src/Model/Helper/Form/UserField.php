<?php

namespace MyApp\Model\Helper\Form;
class UserField
{
    private const EMAIL_FIELD='email';
    private const PASSWORD_FIELD='password';
    private const NAME_FIELD='name';
    private const ID_FIELD='id';

    public static function getEmailField():string
    {
        return self::EMAIL_FIELD;
    }
    public static function getPasswordField():string
    {
        return self::PASSWORD_FIELD;
    }
    public static function getNameField():string
    {
        return self::NAME_FIELD;
    }
    public static function getId():string
    {
        return self::ID_FIELD;
    }

}