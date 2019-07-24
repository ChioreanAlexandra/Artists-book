<?php

use PHPImageWorkshop\ImageWorkshop;

/**
 * Resize the height of the image respecting the initial ratio,
 * if the argument is set.
 *
 * @param array $payload
 * @return array containing the arguments and the modified image
 * @throws ImagickException
 */
function executeHeight (array $payload):array
{
    if(!canExecute($payload,HEIGHT))
    {
        return $payload;
    }
    $height =(int) $payload[HEIGHT];

    /** @var \Imagick $image */

    $image = $payload[IMAGE];
    $image->scaleImage(0,$height);
    $payload[IMAGE]=$image;
    return $payload;

}