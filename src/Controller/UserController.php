<?php


namespace MyApp\Controller;


use MyApp\Model\DomainObjects\User;
use MyApp\Model\FormMapper\LoginFormMapper;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Session;
use MyApp\Model\Validation\FormValidators\LoginFormValidator;
use MyApp\Model\Http\Request;
use MyApp\View\Renderers\LoginRenderer;
use MyApp\View\Renderers\ProfilePageRenderer;
use MyApp\View\Renderers\RegisterRenderer;


class UserController
{
    /** @var array */
    public static $error;

    public static function loginPage()
    {
        LoginRenderer::render();
    }

    public static function getRequest():Request
    {
        return new Request();
    }

    public static function getSession():Session
    {
        return new Session();
    }

    public static function login()
    {
        $password='1234';
        $email='ale@yahoo.com';
        $request=self::getRequest();
        $error=[];
        $loginFormMapper=new LoginFormMapper($request);
        $loginUser=$loginFormMapper->createUserFromLoginForm();
        echo $loginUser;
        if($password != $loginUser->getPassword())
        {
            $error[UserField::getPasswordField()]='Wrong password';
        }
        if($email != $loginUser->getEmail())
        {
            $error[UserField::getEmailField()]='Wrong email';
        }

        if(!empty($error)) {
            LoginRenderer::render($error);
            return;
        }
        $session=self::getSession();
        $session->setSessionValue(UserField::getId(),11);
        header('Location:/user/profile');

    }

    public static function registerPage()
    {
        RegisterRenderer::render();
    }

    public static function register()
    {
        require_once("src/View/Templates/profile-page.php");
    }

    public static function profile()
    {
        ProfilePageRenderer::render();
        //require_once("src/View/Templates/profile-page.php");
    }
}