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



?><!DOCTYPE html>
<html>
<head>
    <title>Upload image</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="content">
    <h1>Upload image</h1>
    <form action="" method=POST enctype="multipart/form-data">
        <label for="imageTitle">Image title</label><br/>
        <input id="imageTitle" type="text" placeholder="Enter the image title" name="imageTitle"/>

        <br/>
        <br/>
        <label for="imageDescription">Image description</label><br/>
        <input id="imageDescription" type="text" placeholder="Enter an image description" name="imageDescription"/>

        <br/>
        <br/>
        <label for="artistName">Name</label><br/>
        <input id="artistName" type="text" placeholder="Enter your name" name="artistName"/>

        <br/>
        <br/>
        <label for="email">Email</label><br/>
        <input id="email" type="text" placeholder="Enter your email" name="email"/>

        <div style="color: red">
            <?php if(isset($errors[ARTIST_EMAIL]))echo $errors[ARTIST_EMAIL];?>
        </div>

        <br/>
        <br/>
        <label for="cameraSpecs">Camera specifications</label><br/>
        <input id="imageDescription" type="text" placeholder="Enter the camera specifications" name="cameraSpecs"/>

        <br/>
        <br/>
        <label for="imagePrice">Price</label><br/>
        <input id="imagePrice" type="number" placeholder="Enter price" name="imagePrice" step="0.01" min="0">
        <input type="radio" name="currency" value="LEI" checked="checked"> LEI
        <input type="radio" name="currency" value="EUR"> EUR
        <br/>
        <div style="color: red">
            <?php if(isset($errors[PRICE_IMAGE]))echo $errors[PRICE_IMAGE];?>
        </div>


        <br/>
        <label for="date">Capture date</label><br/>
        <input id="date" type="date" name="captureDate">

        <br/>

        <div style="color: red">
            <?php if(isset($errors[DATE]))echo $errors[DATE];?>
        </div>

        <br/>
        <label for="tag[]">Tags</label>
        <select name="tag[]" multiple>
            <option>Adventure Photography</option>
            <option>Astrophotography</option>
            <option>Black and White Photography</option>
            <option>Cityscape Photography</option>
            <option>Creative Photography</option>
            <option>Family Photography</option>
            <option>Fine Art Photography</option>
            <option>Infrared Photography</option>
            <option>Landscape Photography</option>
            <option>Milky Way Photography</option>
        </select>
        <br/>

        <div style="color: red">
            <?php if(isset($error[TAG]))echo $errors[TAG];?>
        </div>

        <br/>


        <label for="image">Image to be uploaded</label> &nbsp;
        <input type="file" name="image"/>
        <br/>
        <div style="color: red">
            <?php if(!empty($errors[IMAGE_FILE_NAME]))echo $errors[IMAGE_FILE_NAME];?>
        </div>
        <br/>
        <br/>
        <input type="submit" value="Upload form" name="submit">
        <div style="color: red">
            <?php if(!empty($errorMessage))echo $errorMessage;?>
        </div>

    </form>
</div>

<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
