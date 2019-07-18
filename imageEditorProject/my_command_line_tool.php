<?php
include "input/cli.php";
include "imageLoad/loadImage.php";
include "operations/width.php";
include "operations/height.php";
include "imageSave/saveImage.php";
include "functions.php";
include "watermark/watermark.php";
include "operations/ratio.php";
include "isHelp/help.php";
include "output/output.php";
include "error/errorFile.php";
include "validation/validation.php";
include "constants.php";

$payload1=readArguments($argv);

if(isHelp($payload1))
{
    showHelp();
    exit();
}
$payload9=validateCommand($payload1);
if(!empty($payload9))
{
    showError(arrayToString($payload9));
    exit();

}
$payload2=readImage($payload1);
$payload3=executeWidth($payload2);
$payload3=executeHeight($payload3);
$payload3=executeFormat($payload3);
$payload4=addWatermark($payload3);
$payload5=saveImageToFile($payload4);
showSuccess($payload5);

