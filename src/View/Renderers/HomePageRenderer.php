<?php


namespace MyApp\View\Renderers;


class HomePageRenderer extends RendererTemplate
{
    private const HOME_PAGE_HTML_FILE='src/View/Templates/home-page.php';

    public function ownRender(array $productList = [])
    {
        require_once "".self::HOME_PAGE_HTML_FILE."";
    }

}