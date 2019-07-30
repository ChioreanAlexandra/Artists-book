<?php


namespace MyApp\Model\Router;


use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\SessionFactory;

class Router
{
    /** @var string */
    public $path;
    const CONTROLLER = 'Controller';
    const NAMESPACE_CONST = 'MyApp\Controller';
    const CLASSNAME_REGEX = '/\/(?<className>[a-z]+)\//';
    const METHODNAME_REGEX = '/[a-z]+\/(?<methodName>[a-zA-Z]+)/';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getClass(string $serverUri): string
    {
        preg_match(CLASSNAME_REGEX, $serverUri, $match);
        if (isset($match['className'])) {
            return ucfirst($match['className']);
        }
        return '';
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
        session_start();
        switch ($this->path) {
            case '/':
                call_user_func('MyApp\Controller\ProductController::showProducts');
                break;
            default:
                $className = $this->getClass($this->path);
                $methodName = $this->getMethod($this->path);
                call_user_func(sprintf('%s\%s%s::%s', NAMESPACE_CONST, $className, CONTROLLER, $methodName));
                break;
        }

    }
}