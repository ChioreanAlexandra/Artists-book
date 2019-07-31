<?php
const CONTROLLER='Controller';
const NAMESPACE_CONST='MyApp\Controller';
const CLASSNAME_REGEX='/\/(?<className>[a-z]+)\//';
const METHODNAME_REGEX='/[a-z]+\/(?<methodName>[a-zA-Z]+)/';

require_once "vendor/autoload.php";
session_start();
$router=new \MyApp\Model\Router\Router($_SERVER['REQUEST_URI']);
$router->getRoute();
