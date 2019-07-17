<?php

use PHPImageWorkshop\ImageWorkshop;




function executeHeight (array $payload):array
{
    if(!canExecute($payload,'height'))
    {
        return $payload;
    }
    $height = castIntType($payload['height']);

    /** @var \Imagick $image */

    $image = $payload['image'];
    $image->scaleImage(0,$height);
    $payload['image']=$image;
    return $payload;

}