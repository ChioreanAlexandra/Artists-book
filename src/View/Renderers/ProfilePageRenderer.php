<?php


namespace MyApp\View\Renderers;


class ProfilePageRenderer
{
    private const PROFILE_PAGE_HTML_FILE='src/View/Templates/profile-page.php';

    public static function render(array $error=[])
    {
        require_once "".self::PROFILE_PAGE_HTML_FILE."";
    }
}