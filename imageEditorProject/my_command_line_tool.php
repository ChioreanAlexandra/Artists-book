<?php
include "input/cli.php";
include "imageLoad/loadImage.php";
include "operations/width.php";
include "operations/height.php";
include "imageSave/saveImage.php";
include "functions.php";
include "watermark/watermark.php";

$payload1=readArguments($argv);
$payload2=readImage($payload1);
$payload3=executeWidth($payload2);
$payload3=executeHeight($payload3);
$payload4=addWatermark($payload3);
saveImageToFile($payload3);
//canExecute($payload2);
//var_dump($payload2);
