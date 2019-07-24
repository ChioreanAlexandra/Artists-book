<?php
const SCALE_VALUE=15;

/**
 * Compute the coordinates for drawing the watermark image.
 *
 * @param int $widthImage
 * @param int $heightImage
 * @param $widthWatermark
 * @param $heightWatermark
 * @return array
 */

function computeRandomCoordinates(int $widthImage, int $heightImage, $widthWatermark, $heightWatermark): array
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
    return [WIDTH => $newWidth, HEIGHT => $newHeight];
}

/**
 * Add and resize the watermark image to a random corner of the image.
 *
 * @param array $payload
 * @return array
 * @throws ImagickException
 */
function addWatermark(array $payload): array
{
    if(!isset($payload[WATERMARK]))
    {
        return $payload;
    }
    /**@var \Imagick $image */

    $image = $payload[IMAGE];
    $watermarkImage = new Imagick($payload[WATERMARK]);
    $watermarkImage->scaleImage($image->getImageWidth()/SCALE_VALUE,$image->getImageHeight()/SCALE_VALUE);
    $coordinates = computeRandomCoordinates($image->getImageWidth(), $image->getImageHeight(), $watermarkImage->getImageWidth(), $watermarkImage->getImageHeight());
    $image->compositeImage($watermarkImage, imagick::COMPOSITE_OVER, $coordinates[WIDTH], $coordinates[HEIGHT]);
    $payload[IMAGE] = $image;
    unset($payload[WATERMARK]);
    return $payload;

}