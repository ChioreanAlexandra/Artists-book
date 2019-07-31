<?php


namespace MyApp\View\Renderers;


class ProductPageRenderer extends RendererTemplate
{
    private const PRODUCT_PAGE_HTML_FILE = 'src/View/Templates/product-page.php';

    public function ownRender(array $data = [])
    {
        require_once "" . self::PRODUCT_PAGE_HTML_FILE . "";
    }
}