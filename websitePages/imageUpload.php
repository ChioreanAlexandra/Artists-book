<?php

include "input.php";
include "validations.php";
include "saveImage.php";
ini_set('display_errors', 'ON');
$errorMessage=validateEmptyFields();
$errors=[];
if(empty($errorMessage) && $_POST)
{

    $inputValues=getInputValues();
    $errors=validateInput($inputValues);
    var_dump($inputValues);
    var_dump($errors);
    if(empty($errors))
    {
        echo 'aici';
        $path=createDirectory($inputValues[ARTIST_NAME],$inputValues[ARTIST_EMAIL]);
        saveImage($path,$inputValues[FILE_NAME],$inputValues[FILE_LOCATION]);
        saveFile($inputValues,$path);
    }
}



?><!DOCTYPE html>
<html>
<head>
    <title>Admin homepage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <div>
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
        <br/>
        <div>
            <?php if(isset($errors[PRICE_IMAGE]))echo $errors[PRICE_IMAGE];?>
        </div>


        <br/>
        <label for="date">Capture date</label><br/>
        <input id="date" type="date" name="captureDate">

        <br/>

        <div>
            <?php if(isset($errors[DATE]))echo $errors[DATE];?>
        </div>

        <br/>
        <label for="tags">Tags</label>
        <select name="tag">
            <option>Nu vreau sa fac asta</option>
        </select>
        <br/>

        <div>
            <?php if(isset($error[TAG]))echo $errors[TAG];?>
        </div>

        <br/>


        <label for="image">Image to be uploaded</label> &nbsp;
        <input type="file" name="image"/>
        <Br/>
        <div>
            <?php if(!empty($errors[FILE_NAME]))echo $errors[FILE_NAME];?>
        </div>
        <Br/>
        <Br/>
        <input type="submit" value="Upload form" name="submit">
        <div>
            <?php if(!empty($errorMessage))echo $errorMessage;?>
        </div>

    </form>
</div>

<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
