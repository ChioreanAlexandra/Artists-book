<?php


function readImage(array $infos):array
{
    $payload2=[];
    $fileName = array_shift($infos);
    $image=new Imagick($fileName);
    $payload2=$infos+['image'=>$image];
    return $payload2;
}
