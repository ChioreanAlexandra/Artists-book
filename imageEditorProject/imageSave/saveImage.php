<?php
function saveImageToFile(array $payload4)
{
    $outputFile=array_shift($payload4);
    $image = $payload4['image'];
    /**
     * @var \Imagick $image
     */
    $image->writeImage($outputFile);
}