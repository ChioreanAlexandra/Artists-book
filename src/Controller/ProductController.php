<?php

namespace MyApp\Controller;
class ProductController
{
    public static function showProducts()
    {
        require_once("src/View/Templates/home-page.php");

    }

    public static function showProduct()
    {
        require_once("src/View/Templates/product-page.php");

    }

    public static function uploadProductPage()
    {
        require_once("src/View/Templates/upload-form.php");
    }


    public static function uploadProduct()
    {
        require_once("src/View/Templates/profile-page.php");
    }

    public static function buyProduct()
    {
        echo 'on buy';
        //require_once("src/View/Templates/home-page.php");

    }

}