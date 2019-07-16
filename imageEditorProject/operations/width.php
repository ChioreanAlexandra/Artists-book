<?php

use PHPImageWorkshop\ImageWorkshop;

function executeWidth (array $payload):array
{
    if(!canExecute($payload,'width'))
    {
        return $payload;
    }
    $width = castFloatType($payload['width']);

    /** @var \Imagick $image */

    $image = $payload['image'];
    $image -> adaptiveResizeImage($image->getImageHeight(),$width);
    $payload['image']=$image;
    return $payload;



}