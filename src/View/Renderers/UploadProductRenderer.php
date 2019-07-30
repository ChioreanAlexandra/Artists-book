<?php


namespace MyApp\View\Renderers;


class UploadProductRenderer
{
    private const UPLOAD_PRODUCT_HTML_FILE = 'src/View/Templates/upload-form.php';

    public static function render(array $tags = [])
    {

        require_once "" . self::UPLOAD_PRODUCT_HTML_FILE . "";
    }
}