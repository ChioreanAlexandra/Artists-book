<?php


namespace MyApp\Controller;


use MyApp\Model\Http\RequestFactory;
use MyApp\Model\Http\SessionFactory;
use MyApp\Model\Persistence\Finder\UserFinder;
use MyApp\Model\Persistence\Mapper\UserMapper;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\Model\DomainObjects\User;
use MyApp\Model\FormMapper\LoginFormMapper;
use MyApp\Model\FormMapper\RegisterFormMapper;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Session;
use MyApp\Model\Validation\FormValidators\LoginFormValidator;
use MyApp\Model\Http\Request;
use MyApp\View\Renderers\LoginRenderer;
use MyApp\View\Renderers\ProfilePageRenderer;
use MyApp\View\Renderers\RegisterRenderer;
use MyApp\Model\Persistence\Finder\AbstractFinder;


class UserController
{
    /** @var array */
    public static $error;

    public static function loginPage()
    {
        LoginRenderer::render();
    }


    public static function login()
    {
        $request=RequestFactory::createRequest();
        $error=[];

        $loginFormMapper=new LoginFormMapper($request);
        $loginUser=$loginFormMapper->createUserFromLoginForm();
        ///echo $loginUser;

        /** @var UserFinder $userFinder */
        $userFinder = PersistenceFactory::createFinder(User::class);
        /** @var User $user */
        $user = $userFinder->findByCredentials($loginUser->getEmail(), $loginUser->getPassword());
        var_dump($user);

        if($user==null)
        {
            $error['error']='Email/password wrong';
            LoginRenderer::render($error);
            return;
        }

        $session=SessionFactory::createSession();
        $session->setSessionValue(UserField::getId(),$user->getId());
        header('Location:/user/profile');

    }

    public static function registerPage()
    {
        $renderer=new RegisterRenderer();
        $renderer->render();
    }

    public static function register()
    {
        $request=RequestFactory::createRequest();
        $error=[];
        $registerFormMapper=new RegisterFormMapper($request);
        $registerUser=$registerFormMapper->createUserFromRegisterForm();
        /** @var UserMapper $userMapper */
        $userMapper = PersistenceFactory::createMapper(User::class);
        $userId=$userMapper->save($registerUser);
        $session=SessionFactory::createSession();
        $session->setSessionValue(UserField::getId(),$userId);
        var_dump($session->getSession());
        require_once("src/View/Templates/profile-page.php");
    }

    public static function profile()
    {
        $renderer=new ProfilePageRenderer();
        $renderer->render();

        //require_once("src/View/Templates/profile-page.php");
    }
    public static function logout()
    {
        $session=SessionFactory::createSession();
        $session->unsetSessionKey(UserField::getId());
        header("Location:/product/showProducts");
    }
}