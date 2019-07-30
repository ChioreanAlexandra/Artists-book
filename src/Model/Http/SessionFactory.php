<?php


namespace MyApp\Model\Http;

use MyApp\Model\Http\Session;
class SessionFactory
{
    public static function createSession():Session
    {
        return new Session();
    }
}