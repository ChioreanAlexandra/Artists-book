<?php
session_start();
include "input.php";
include "saveImage.php";
include "constants.php";
include "validations.php";
ini_set('display_errors', 'ON');
$errorMessage=validateEmptyFields();
$errors=[];
if(empty($errorMessage) && $_POST)
{

    $inputValues=getInputValues();
    $errors=validateInput($inputValues);
    if(empty($errors))
    {
        $folderPath=createDirectory($inputValues[ARTIST_NAME],$inputValues[ARTIST_EMAIL]);

        $uniqueName=uniqid();
        preg_match(VALIDATE_EXTENSION_PATTERN,$inputValues[ORIGINAL_IMAGE_NAME],$match);
        $imageExtension=$match['ext'];
        $inputValues[IMAGE_NAME]=$uniqueName.'.'.$imageExtension;

        saveImageToDirectory($folderPath,$inputValues[IMAGE_NAME],$inputValues[TEMP_FILE_LOCATION]);

        unset($inputValues[TEMP_FILE_LOCATION]); //image location no longer needed in the array storing inputs

        $infoFilePath=writeDetailsIntoFile($inputValues,$folderPath,$uniqueName);

        $_SESSION[ARTIST_NAME]=$inputValues[ARTIST_NAME];
        $_SESSION[ARTIST_EMAIL]=$inputValues[ARTIST_EMAIL];
        $_SESSION[INFO_FILE_NAME]=$infoFilePath;

        header('Location:successPage.php');
    }
}



?>