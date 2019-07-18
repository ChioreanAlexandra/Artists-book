<?php

use PHPImageWorkshop\ImageWorkshop;

/**
 *Resize the width of the image respecting the initial ratio,
 * if the argument is set.
 *
 * @param array $payload
 * @return array containing the arguments and the modified image
 * @throws ImagickException
 */
function executeWidth (array $payload):array
{
    if(!canExecute($payload,WIDTH))
    {
        return $payload;
    }
    $width = castIntType($payload[WIDTH]);

    /** @var \Imagick $image */

    $image = $payload[IMAGE];
    $image->scaleImage($width,0);
    $payload[IMAGE]=$image;
    return $payload;



}