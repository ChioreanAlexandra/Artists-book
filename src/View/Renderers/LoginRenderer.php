<?php

namespace MyApp\View\Renderers;

class LoginRenderer extends RendererTemplate
{
    private const LOGIN_HTML_FILE='src/View/Templates/login-form.php';

    public function ownRender(array $errors = null)
    {
        require_once "".self::LOGIN_HTML_FILE."";
    }

}