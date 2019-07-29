<?php


namespace MyApp\Model\Http;


class Session
{
    public function getSession(): array
    {
        return $_SESSION;
    }

    public function getSessionValue(string $key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function setSessionValue(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

}