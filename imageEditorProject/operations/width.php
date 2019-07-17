<?php

use PHPImageWorkshop\ImageWorkshop;

function executeWidth (array $payload):array
{
    if(!canExecute($payload,'width'))
    {
        return $payload;
    }
    $width = castIntType($payload['width']);

    /** @var \Imagick $image */

    $image = $payload['image'];
    $image->scaleImage($width,0);
    $payload['image']=$image;
    return $payload;



}