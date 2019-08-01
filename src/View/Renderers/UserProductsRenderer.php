<?php


namespace MyApp\View\Renderers;


class UserProductsRenderer extends RendererTemplate
{
    private const USER_PRODUCT_PAGE_HTML_FILE='src/View/Templates/user-products-page.php';

    public function ownRender(array $productList = [])
    {
        require_once "".self::USER_PRODUCT_PAGE_HTML_FILE."";
    }
}