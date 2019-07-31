<?php


namespace MyApp\View\Renderers;


class UploadProductRenderer extends RendererTemplate
{
    private const UPLOAD_PRODUCT_HTML_FILE = 'src/View/Templates/upload-form.php';

    public function ownRender(array $tags = [])
    {
        require_once "" . self::UPLOAD_PRODUCT_HTML_FILE . "";
    }
}