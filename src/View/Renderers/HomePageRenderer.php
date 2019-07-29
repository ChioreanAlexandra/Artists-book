<?php


namespace MyApp\View\Renderers;


class HomePageRenderer
{
    private const HOME_PAGE_HTML_FILE='src/View/Templates/home-page.php';

    public static function render(array $error = [])
    {
        require_once "".self::HOME_PAGE_HTML_FILE."";
    }
}