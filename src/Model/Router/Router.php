<?php


namespace MyApp\Model\Router;


use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;
use MyApp\Model\Http\RequestFactory;
use MyApp\Model\Http\Session;
use MyApp\Model\Http\SessionFactory;

class Router
{
    /** @var string */
    public $path;
    const CONTROLLER = 'Controller';
    const NAMESPACE_CONST = 'MyApp\Controller\\';
    const CLASSNAME_REGEX = '/\/(?<className>[a-z]+)\//';
    const METHODNAME_REGEX = '/[a-z]+\/(?<methodName>[a-zA-Z]+)/';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getControllerClass(string $controller): string
    {

        return self::NAMESPACE_CONST . ucfirst($controller) . self::CONTROLLER;

    }

    public function getMethod(string $serverUri): string
    {
        preg_match(METHODNAME_REGEX, $serverUri, $match);
        if (isset($match['methodName'])) {
            return $match['methodName'];
        }
        return '';
    }

    public function getRoute()
    {
        $route = Route::createFromString($this->path);
        $controllerClass = $this->getControllerClass($route->getController());
        if (!class_exists($controllerClass)) {
            $controllerClass = 'MyApp\Controller\ProductController';
        }
        $method = $route->getAction();
        if (!method_exists($controllerClass, $method)) {
            $method = 'showProducts';
        }

        $controller = new $controllerClass(new Session(),new Request());
        $controller->{$method}($route->getParam());


    }
}