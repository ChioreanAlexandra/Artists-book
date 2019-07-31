<?php


namespace MyApp\Model\FormMapper;


use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\Helper\Form\ImageFields;
use MyApp\Model\Helper\Form\TierFields;
use MyApp\Model\Http\Request;

class TierFactory
{
    public function createAllTiersForProduct(int $productId)
    {
        $request = new Request();
        $inputFile = $_FILES[ImageFields::getImageTag()][ImageFields::getImageTemporaryLocation()];
        $fileName = $_FILES[ImageFields::getImageTag()][ImageFields::getImageFileName()];
        preg_match('/(?<ext>\.\w+)/', $fileName, $match);

        $tiers[] = $this->createTier($productId, $inputFile, TierFields::getSizeLarge(), $request->getPost()[TierFields::getPriceLarge()]);
        $tiers[] = $this->createTier($productId, $inputFile, TierFields::getSizeMedium(), $request->getPost()[TierFields::getPriceMedium()]);
        $tiers[] = $this->createTier($productId, $inputFile, TierFields::getSizeSmall(), $request->getPost()[TierFields::getPriceSmall()]);
        return $tiers;
    }

    public function createTier(int $productId, string $inputFile, string $size, float $price, string $extension = 'jpg')
    {

        $outputPath = sprintf("%s/%s.%s", ImageFields::getImagesDirectory(), uniqid(), $extension);
        $outputPathWM = sprintf("%s/%s.%s", ImageFields::getImagesDirectory(), uniqid(), $extension);
        // $this->processImage();
        return new Tier($productId, $size, $price, $outputPathWM, $outputPath, null);
    }

    private function processImage(string $inputPath, string $outputPath, float $width, float $height, float $watermark = null)
    {

    }
}
