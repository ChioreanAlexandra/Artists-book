<?php


function readImage(array $infos):array
{
    $payload2=[];
    var_dump($infos);
    $fileName = array_shift($infos);
    /*$handler=fopen($fileName,'r');
    $resource=$handler;
    $payload2=$infos+['image'=>$resource];
    fclose($handler);*/
    $image=new Imagick($fileName);
    $payload2=$infos+['image'=>$image];
    return $payload2;
}
