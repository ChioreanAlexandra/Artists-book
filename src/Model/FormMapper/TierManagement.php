<?php


namespace MyApp\Model\FormMapper;


use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Editor\EditorFactory;
use MyApp\Model\Helper\Form\ImageFields;
use MyApp\Model\Helper\Form\TierFields;
use MyApp\Model\Http\Request;

class TierManagement
{
    private $savedFile;

    public function __construct()
    {
        $this->saveImage($_FILES[ImageFields::getImageTag()][ImageFields::getImageTemporaryLocation()]);
    }

    public function createAllTiersForProduct(int $productId)
    {
        $request = new Request();
        $fileName = $_FILES[ImageFields::getImageTag()][ImageFields::getImageFileName()];
        preg_match('/(?<ext>\.\w+)/', $fileName, $match);

        $tiers[] = $this->createTier($productId, $this->savedFile, TierFields::getSizeLarge(), $request->getPost()[TierFields::getPriceLarge()], $match['ext']);
        $tiers[] = $this->createTier($productId, $this->savedFile, TierFields::getSizeMedium(), $request->getPost()[TierFields::getPriceMedium()], $match['ext']);
        $tiers[] = $this->createTier($productId, $this->savedFile, TierFields::getSizeSmall(), $request->getPost()[TierFields::getPriceSmall()], $match['ext']);
        return $tiers;
    }

    public function createTier(int $productId, string $inputFile, string $size, float $price, string $extension = 'jpg')
    {
        $outputFileName = sprintf("%s%s", uniqid(), $extension);
        $outputFileNameWM = sprintf("%s%s", uniqid(), $extension);
        $outputPath = ImageFields::getImagesDirectory() . $outputFileName;
        $outputPathWM = ImageFields::getImagesDirectory() . $outputFileNameWM;
        $this->processImage($inputFile, $outputPath, $size, null);
        $this->processImage($inputFile, $outputPathWM, $size, ImageFields::WATERMARK_FILE);
        return new Tier($productId, $size, $price, $outputFileNameWM, $outputFileName, null);
    }

    private function processImage(string $inputPath, string $outputPath, string $type, string $watermark = null)
    {
        $imageEditor = new EditorFactory();
        $exe=$imageEditor->createCommand($inputPath, $outputPath, $type, $watermark);
        $exe->execute();

    }

    public function createThumbNail(string $thumbnailFileName)
    {
        $thumbnailPath = ImageFields::getImagesDirectory() . $thumbnailFileName;
        $this->processImage($this->savedFile, $thumbnailPath, 'thumbnail', ImageFields::WATERMARK_FILE);
    }

    private function saveImage(string $inputFile)
    {
        var_dump($inputFile);
        $this->savedFile = ImageFields::getImagesDirectory().sprintf("%s.%s", uniqid(), 'jpg');
        move_uploaded_file($inputFile,  $this->savedFile);

    }
}
