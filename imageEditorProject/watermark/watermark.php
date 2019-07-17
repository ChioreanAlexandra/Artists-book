<?php
const SCALE_VALUE=15;
function computeCoordinates(int $widthImage, int $heightImage, $widthWatermark, $heightWatermark): array
{
    $newWidth = 0;
    $newHeight = 0;
    $xArray = [0, $widthImage];
    $yArray = [0, $heightImage];
    $x = array_rand($xArray, 1);
    $y = array_rand($yArray, 1);
    if ($x == 1 ) {
        $newWidth = $widthImage - $widthWatermark;
    }
    if ($y == 1) {
        $newHeight = $heightImage - $heightWatermark;
    }
    return ['width' => $newWidth, 'heigth' => $newHeight];
}

function addWatermark(array $payload): array
{
    /**@var \Imagick $image
     */

    $image = $payload['image'];
    $watermarkImage = new Imagick($payload['watermark']);
    $watermarkImage->scaleImage($image->getImageWidth()/SCALE_VALUE,$image->getImageHeight()/SCALE_VALUE);
    $coordinates = computeCoordinates($image->getImageWidth(), $image->getImageHeight(), $watermarkImage->getImageWidth(), $watermarkImage->getImageHeight());
    var_dump($coordinates);
    $image->compositeImage($watermarkImage, imagick::COMPOSITE_OVER, $coordinates['width'], $coordinates['heigth']);
    $payload['image'] = $image;
    unset($payload['watermark']);
    return $payload;

}