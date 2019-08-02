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

    /**
     * Calls create tier method for each tier size: small, medium, large.
     * @param int $productId
     * @return array
     */
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

    /**
     * Process tier and creates tier
     * @param int $productId
     * @param string $inputFile
     * @param string $size
     * @param float $price
     * @param string $extension
     * @return Tier
     *
     * TODO:refactor :split in 2 methods
     */
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

    /**
     * Execute image editor application with given parameters
     * @param string $inputPath
     * @param string $outputPath
     * @param string $type
     * @param string|null $watermark
     */
    private function processImage(string $inputPath, string $outputPath, string $type, string $watermark = null)
    {
        $imageEditor = new EditorFactory();
        $exe=$imageEditor->createImageEditor($inputPath, $outputPath, $type, $watermark);
        $exe->execute();

    }

    /**
     * Process Thumbnail photo
     * @param string $thumbnailFileName
     */
    public function processThumbnail(string $thumbnailFileName)
    {
        $thumbnailPath = ImageFields::getImagesDirectory() . $thumbnailFileName;
        $this->processImage($this->savedFile, $thumbnailPath, 'thumbnail', ImageFields::WATERMARK_FILE);
    }

    /**
     * Save uploaded photo.
     * @param string $inputFile
     */
    private function saveImage(string $inputFile)
    {
        $this->savedFile = ImageFields::getImagesDirectory().sprintf("%s.%s", uniqid(), 'jpg');
        move_uploaded_file($inputFile,  $this->savedFile);

    }
}
