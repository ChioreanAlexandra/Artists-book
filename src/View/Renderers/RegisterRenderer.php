<?php


namespace MyApp\View\Renderers;


class RegisterRenderer extends RendererTemplate
{
    private const REGISTER_HTML_FILE = 'src/View/Templates/register-form.php';

    public function ownRender(array $error = null)
    {
        require_once "" . self::REGISTER_HTML_FILE . "";
    }


}