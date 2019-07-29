<?php

namespace MyApp\View\Renderers;

class LoginRenderer
{
    private const LOGIN_HTML_FILE='src/View/Templates/login-form.php';

    public static function render(array $errors = [])
    {
        require_once "".self::LOGIN_HTML_FILE."";
    }

}