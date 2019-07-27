<?php


namespace MyApp\Controller;


class UserController
{
    public static function loginPage()
    {
        require_once ("src/View/Templates/login-form.php");

    }

    public static function login()
    {
       // echo 'esti pe post';
        require_once ("src/View/Templates/home-page.php");

    }

    public static function registerPage()
    {
        require_once ("src/View/Templates/register-form.php");
    }

    public static function register()
    {
        require_once ("src/View/Templates/profile-page.php");
    }
}