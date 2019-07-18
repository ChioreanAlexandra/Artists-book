<?php

/**
 * @param array $payload keeps the value of each parameter
 * @return array containing the new image
 * @throws ImagickException
 */
function readImage(array $payload):array
{
    $payload2=[];
    $fileName = $payload[INPUT_FILE];
    $image=new Imagick($fileName);
    $payload2=$payload+[IMAGE=>$image];
    unset($payload2[INPUT_FILE]); //remove input file name because we don't need/use it anymore
    return $payload2;
}

