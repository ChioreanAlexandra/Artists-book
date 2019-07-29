<?php

namespace MyApp\Controller;
use MyApp\View\Renderers\HomePageRenderer;
use MyApp\View\Renderers\ProductPageRenderer;
use MyApp\View\Renderers\UploadProductRenderer;

class ProductController
{
    /** @var array  */
    public static function showProducts()
    {
        HomePageRenderer::render();
    }

    public static function showProduct()
    {
        ProductPageRenderer::render();
    }

    public static function uploadProductPage()
    {
        UploadProductRenderer::render();
    }

    public static function uploadProduct()
    {
        header("Location:/user/profile/");
    }

    public static function buyProduct()
    {
        echo 'on buy';
        //require_once("src/View/Templates/home-page.php");git +
    }

}