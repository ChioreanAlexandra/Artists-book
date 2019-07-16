<?php

use PHPImageWorkshop\ImageWorkshop;




function executeHeight (array $payload):array
{
    if(!canExecute($payload,'height'))
    {
        return $payload;
    }
    $height = castFloatType($payload['height']);

    /** @var \Imagick $image */

    $image = $payload['image'];
    $image -> adaptiveResizeImage($height,$image->getImageWidth());
    $payload['image']=$image;
    return $payload;

}