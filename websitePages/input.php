<?php
const DATE_PATTERN='/(?<year>\d\d\d\d)-(?<month>\d\d)-(?<day>\d\d)/';
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
    $inputValues[ORIGINAL_IMAGE_NAME]=$_FILES[IMAGE_TAG][IMAGE_FILE_NAME];
    $inputValues[TEMP_FILE_LOCATION]=$_FILES[IMAGE_TAG][TEMP_FILE_LOCATION];

    return $inputValues;
}



