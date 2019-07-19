<?php
const IMAGE_TITLE = 'imageTitle';
const IMAGE_DESCR = 'imageDescription';
const ARTIST_NAME = 'artistName';
const ARTIST_EMAIL = 'email';
const CAMERA_SPECS = 'cameraSpecs';
const PRICE_IMAGE = 'imagePrice';
const DATE = 'captureDate';
const TAG = 'tag';
const FILE_LOCATION ='tmp_name';
const FILE_NAME='name';
const IMAGE_TAG='image';
const DATE_PATTERN='/(?<year>\d\d\d\d)-(?<month>\d\d)-(?<day>\d\d)/';
const TAGS=['NU'];
/**
 * Check if all the text inputs are filled
 * @return string
 */


/**
 * Saves the input values into an array
 * @return array
 */
function getInputValues():array
{
    $inputValues=[];
    foreach ($_POST as $key=>$value)
    {
      $inputValues[$key]=$value;
    }
    var_dump($_FILES);
    $inputValues[FILE_NAME]=$_FILES[IMAGE_TAG][FILE_NAME];
    $inputValues[FILE_LOCATION]=$_FILES[IMAGE_TAG][FILE_LOCATION];
    return $inputValues;
}



