<?php


namespace MyApp\Model\Utilities;


use MyApp\Model\Helper\Form\ImageFields;

class DownloadClass
{
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * sets header needed for downloading
     */
    public function startDownload()
    {
        if (!file_exists(ImageFields::IMAGES_DIRECTORY . $this->fileName)) {
            return;
        }
        // prevent whitespaces from corrupting the image
        // "If you work on an extremely large project with a lot of source and required files, like myself,
        // you will be well-advised to always clear the output buffer prior to creating an image in php."
        // see https://www.php.net/manual/ro/function.ob-clean.php#75694
        ob_clean();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename(ImageFields::IMAGES_DIRECTORY . $this->fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize(ImageFields::IMAGES_DIRECTORY . $this->fileName));
        flush();

        readfile(ImageFields::IMAGES_DIRECTORY . $this->fileName);

    }
}