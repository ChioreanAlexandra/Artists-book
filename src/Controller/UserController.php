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
use MyApp\View\Renderers\OrdersPageRenderer;
use MyApp\View\Renderers\ProfilePageRenderer;
use MyApp\View\Renderers\RegisterRenderer;
use MyApp\Model\Persistence\Finder\AbstractFinder;
use MyApp\View\Renderers\UploadProductRenderer;
use MyApp\View\Renderers\UserProductsRenderer;


class UserController
{
    private $session;
    private $request;

    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    /**
     * Shows login page
     */
    public function loginPage()
    {
        $renderer = new LoginRenderer();
        $renderer->render();
    }

    /**
     * Creates an user from login form and validate it; Redirect to register or product page.
     */
    public function login()
    {
        $error = [];
        $loginValidator = new LoginFormValidator($this->request->getPost());
        if (!empty($loginValidator->validate())) {
            var_dump($loginValidator->validate());
        }
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
        header('Location:/product/showProducts');

    }

    /**
     *Show register page
     */
    public function registerPage()
    {
        $renderer = new RegisterRenderer();
        $renderer->render();
    }

    /**
     * Creates an user from register form; Save user into database; Redirect to homepage, login
     */
    public function register()
    {
        $registerFormMapper = new RegisterFormMapper($this->request);
        $registerUser = $registerFormMapper->createUserFromRegisterForm();
        /** @var UserMapper $userMapper */
        $userMapper = PersistenceFactory::createMapper(User::class);
        $userId = $userMapper->save($registerUser);
        $this->session->setSessionValue(UserField::getId(), $userId);
        header('Location:/product/showProducts');
    }

    /**
     * Shows account page with user infos
     */
    public function profile()
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            header("Location:/product/showProducts");
        }
        $userId = $this->session->getSessionValue(UserField::getId());
        $userFinder = PersistenceFactory::createFinder(User::class);
        /** @var User $user */
        $user = $userFinder->findById($userId);
        $renderer = new ProfilePageRenderer();
        $renderer->render(['user' => $user]);
    }

    public function logout()
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            header("Location:/product/showProducts");
        }
        $this->session->unsetSessionKey(UserField::getId());
        header("Location:/product/showProducts");
    }

    /**
     * Shows user products page
     */
    public function showProducts()
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            header("Location:/product/showProducts");
        }
        $userId = $this->session->getSessionValue(UserField::getId());
        $products = User::getProducts($userId);
        $renderer = new UserProductsRenderer();
        $renderer->render($products);
    }

    /**
     * Show users order page
     */
    public function showOrders()
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            header("Location:/product/showProducts");
        }
        $userId = $this->session->getSessionValue(UserField::getId());
        $orders = User::getOrders($userId);
        $renderer = new OrdersPageRenderer();
        $renderer->render($orders);
    }
}