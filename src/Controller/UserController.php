<?php


namespace MyApp\Controller;

use MyApp\Model\DomainObjects\User;
use MyApp\Model\Validation\FormValidators\LoginFormValidator;

class UserController
{
    public static function loginPage()
    {
        require_once("src/View/Templates/login-form.php");
    }

    public static function login()
    {
        header('Location:/user/profile');

    }

    public static function registerPage()
    {
        require_once("src/View/Templates/register-form.php");
    }

    public static function register()
    {
        require_once("src/View/Templates/profile-page.php");
    }

    public static function profile()
    {
        require_once("src/View/Templates/profile-page.php");
    }
}