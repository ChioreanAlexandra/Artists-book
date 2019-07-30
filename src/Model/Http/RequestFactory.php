<?php


namespace MyApp\Model\Http;

use MyApp\Model\Http\Request;
class RequestFactory
{

    public static function createRequest():Request
    {
        return new Request();
    }

}