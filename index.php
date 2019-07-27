<?php
const CONTROLLER='Controller';
const NAMESPACE_CONST='MyApp\Controller';
const CLASSNAME_REGEX='/\/(?<className>[a-z]+)\//';
const METHODNAME_REGEX='/[a-z]+\/(?<methodName>[a-zA-Z]+)/';

require_once "vendor/autoload.php";

function getClass(string $serverUri):string
{
    preg_match(CLASSNAME_REGEX,$serverUri,$match);
    if(isset($match['className']))
    {
        return ucfirst($match['className']);
    }
    return '';
}
function getMethod(string $serverUri):string
{
    preg_match(METHODNAME_REGEX,$serverUri,$match);
    if(isset($match['methodName']))
    {
        return $match['methodName'];
    }
    return '';
}
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        call_user_func('MyApp\Controller\ProductController::showProducts');
        break;
    default:$className=getClass($_SERVER['REQUEST_URI']);
            $methodName=getMethod($_SERVER['REQUEST_URI']);
            call_user_func(sprintf('%s\%s%s::%s',NAMESPACE_CONST,$className,CONTROLLER,$methodName)); break;
}
