<?php


namespace MyApp\View\Renderers;


class RegisterRenderer
{
    private const REGISTER_HTML_FILE = 'src/View/Templates/register-form.php';

    public static function render(array $error = [])
    {
        require_once "" . self::REGISTER_HTML_FILE . "";
    }

}