<?php
/**
 * @param array $payload4
 * @return string
 */
function saveImageToFile(array $payload4): string
{
    $outputFile = $payload4[OUTPUT_FILE];
    $image = $payload4[IMAGE];
    /**@var \Imagick $image*/
    $image->writeImage($outputFile);
    return $outputFile;
}