<?php


namespace MyApp\View\Renderers;


class ProductPageRenderer
{
    private const PRODUCT_PAGE_HTML_FILE = 'src/View/Templates/product-page.php';

    public static function render(array $error = [])
    {
        require_once "" . self::PRODUCT_PAGE_HTML_FILE . "";
    }
}