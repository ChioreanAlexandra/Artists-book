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
    private $session;
    private $request;

    public function __construct(Session $session, Request $request)
    {
        $this->session=$session;
        $this->request=$request;
    }

    public function loginPage()
    {
        $renderer = new LoginRenderer();
        $renderer->render();
    }


    public function login()
    {
        $error = [];

        $loginFormMapper = new LoginFormMapper($this->request);
        $loginUser = $loginFormMapper->createUserFromLoginForm();

        /** @var UserFinder $userFinder */
        $userFinder = PersistenceFactory::createFinder(User::class);
        /** @var User $user */
        $user = $userFinder->findByCredentials($loginUser->getEmail(), $loginUser->getPassword());

        if ($user == null) {
            $error['error'] = 'Email/password wrong';
            $renderer = new LoginRenderer();
            $renderer->render($error);
            return;
        }
        $this->session->setSessionValue(UserField::getId(), $user->getId());
        $lastViewedProductId = $this->session->getSessionValue('lastViewedProductId');
        if (!is_null($lastViewedProductId)) {

            $this->session->unsetSessionKey('lastViewedProductId');
            header('Location:/product/showProduct/' . $lastViewedProductId);
            return;
        }
        header('Location:/user/profile');

    }

    public function registerPage()
    {
        $renderer = new RegisterRenderer();
        $renderer->render();
    }

    public function register()
    {
        $error = [];
        $registerFormMapper = new RegisterFormMapper($this->request);
        $registerUser = $registerFormMapper->createUserFromRegisterForm();
        /** @var UserMapper $userMapper */
        $userMapper = PersistenceFactory::createMapper(User::class);
        $userId = $userMapper->save($registerUser);
        $session = SessionFactory::createSession();
        $session->setSessionValue(UserField::getId(), $userId);
        var_dump($session->getSession());
        require_once("src/View/Templates/profile-page.php");
    }

    public function profile()
    {
        $renderer = new ProfilePageRenderer();
        $renderer->render();
    }

    public function logout()
    {
        $session = SessionFactory::createSession();
        $session->unsetSessionKey(UserField::getId());
        header("Location:/product/showProducts");
    }
}