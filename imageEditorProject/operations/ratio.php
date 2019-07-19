<?php
/**
 * Resizing the image with the new format based on the minimum length of width or height
 *
 * @param array $payload
 * @param int $widthRatio
 * @param int $heightRatio
 * @return array
 * @throws ImagickException
 * @author Alexandra Chiorean <alexandra.chiorean@evozon.com>
 */
function changeByFormat(array $payload, int $widthRatio, int $heightRatio): array
{
    /**@var \Imagick $image */
    $image = $payload[IMAGE];

    if (!isset($payload[WIDTH]) && !isset($payload[HEIGHT]))
        if ($image->getImageHeight() < $image->getImageWidth()) {
            $image->scaleImage($image->getImageHeight() * $widthRatio / $heightRatio, $image->getImageHeight());
        } else {
            $image->scaleImage($image->getImageWidth(), $image->getImageWidth() * $heightRatio / $widthRatio);
        }

    $payload[IMAGE] = $image;
    return $payload;
}

/**
 *Resize image with the given format based on width
 *
 * @param array $payload
 * @param int $widthRatio
 * @param int $heightRatio
 * @return array
 * @throws ImagickException
 */
function changeByFormatAndWidth(array $payload, int $widthRatio, int $heightRatio): array
{
    /**@var \Imagick $image */
    $image = $payload[IMAGE];
    $image->scaleImage($image->getImageWidth(), $image->getImageWidth() * $heightRatio / $widthRatio);
    $payload[IMAGE] = $image;
    return $payload;
}

/**
 * Resize image with the given format based on height
 *
 * @param array $payload
 * @param int $widthRatio
 * @param int $heightRatio
 * @return array
 * @throws ImagickException
 */
function changeByFormatAndHeight(array $payload, int $widthRatio, int $heightRatio): array
{
    /**@var \Imagick $image */
    $image = $payload[IMAGE];
    $image->scaleImage($image->getImageHeight() * $widthRatio / $heightRatio, $image->getImageHeight());
    $payload[IMAGE] = $image;
    return $payload;
}

/**
 * Remove the arguments that are useless for the next stages
 *
 * @param array $payload
 * @return array
 */
function removeUnnecessaryOperations(array $payload): array
{
    if (isset($payload[WIDTH])) {
        unset($payload[WIDTH]);
    }

    if (isset($payload[HEIGHT])) {
        unset($payload[HEIGHT]);
    }

    if (isset($payload[FORMAT])) {
        unset($payload[FORMAT]);
    }

    return $payload;
}

/**
 * @param string $formatValue
 * @return array
 */
function getFormatRatio(string $formatValue): array
{
    $formatArray = explode(':', $formatValue);
    $widthRatio = (int)array_shift($formatArray);
    $heightRatio = (int)array_shift($formatArray);
    return [$widthRatio, $heightRatio];
}

/**
 * Check if format should be done. If true, apply the changes depending on width, height if set.
 *
 * @param $payload
 * @return array
 * @throws ImagickException
 */
function executeFormat($payload)
{

    if (!canExecute($payload, FORMAT)) {
        return $payload;
    }

    list($widthRatio, $heightRatio) = getFormatRatio($payload[FORMAT]);

    if (!isset($payload[WIDTH]) && !isset($payload[HEIGHT])) {
        $payload = changeByFormat($payload, $widthRatio, $heightRatio);
        return removeUnnecessaryOperations($payload);
    }

    if (isset($payload[WIDTH]) && !isset($payload[HEIGHT])) {
        $payload = changeByFormatAndWidth($payload, $widthRatio, $heightRatio);
        return removeUnnecessaryOperations($payload);
    }

    $payload = changeByFormatAndHeight($payload, $widthRatio, $heightRatio);
    return removeUnnecessaryOperations($payload);


}