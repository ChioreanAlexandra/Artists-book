<?php


namespace MyApp\View\Renderers;


abstract class RendererTemplate
{
    private const HEADER_FILE = 'src/View/Templates/headerFile.php';
    private const FOOTER_FILE = 'src/View/Templates/footerFile.php';

    /**
     *
     * @param array|null $array
     */
    public function render(array $array = null)
    {
        require "" . self::HEADER_FILE . "";
        $this->ownRender($array);
        require "" . self::FOOTER_FILE . "";
    }

    public abstract function ownRender(array $array);
}