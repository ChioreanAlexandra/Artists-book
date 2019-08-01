<?php


namespace MyApp\View\Renderers;


class OrdersPageRenderer extends RendererTemplate
{
    private const ORDER_PAGE_HTML_FILE='src/View/Templates/orders-page.php';

    public function ownRender(array $tierList = [])
    {
        require_once "".self::ORDER_PAGE_HTML_FILE."";
    }
}