<?php

namespace MyApp\Model\Editor;

use Imagick;

class EditorFactory
{
    /**
     * @param string $inputFile
     * @param string $outputFile
     * @param string $type
     * @param string|null $watermark
     * @return ImageEditor
     */
    public function createImageEditor(string $inputFile, string $outputFile, string $type, string $watermark=null):ImageEditor
    {
        switch ($type)
        {
            case 'small': $width=$this->getWidth($inputFile); $width=$width-(int)(8/10*$width); $height=$this->getHeight($inputFile); $height=$height-(int)(8/10*$height);  break;
            case 'medium':  $width=$this->getWidth($inputFile); $width=$width-(int)(4/10*$width); $height=$this->getHeight($inputFile); $height=$height-(int)(4/10*$height);  break;
            case 'thumbnail': $width=100; $height=100; break;
            default:$width=$this->getWidth($inputFile); $height=$this->getHeight($inputFile); break;
        }
        $command='php /var/www/artists-book/imageEditorProject/my_command_line_tool.php --input-file='.$inputFile
            .' --output-file='.$outputFile.' --width='.$width.' --height='.$height;
        if(!$watermark)
        {
            return new ImageEditor($command);
        }
        return new ImageEditor($command.' --watermark='.$watermark);
    }

    /**
     * Get width of input file
     * @param string $inputFile
     * @return int
     * @throws \ImagickException
     */
    private function getWidth(string $inputFile)
    {
        /** @var Imagick $image */
        $image=new Imagick($inputFile);
        return $image->getImageWidth();
    }
    /** Get height of input file */
    private function getHeight(string $inputFile)
    {
        /** @var Imagick $image */
        $image=new Imagick($inputFile);
        return $image->getImageHeight();
    }
}