<?php


namespace MyApp\View\Renderers;


class ProfilePageRenderer extends RendererTemplate
{
    private const PROFILE_PAGE_HTML_FILE = 'src/View/Templates/profile-page.php';

    public function ownRender(array $data = [])
    {
        require_once "" . self::PROFILE_PAGE_HTML_FILE . "";
    }
}