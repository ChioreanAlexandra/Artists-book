<?php
function saveImageToFile(array $payload4)
{
    $outputFile=array_shift($payload4);
  //  var_dump($payload4);
   // $image=array_shift($payload4);
    $image = $payload4['image'];
    /**
     * @var \Imagick $image
     */
    $image->writeImage($outputFile);
}