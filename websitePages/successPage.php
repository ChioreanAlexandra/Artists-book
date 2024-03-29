<?php
require_once "mainSuccessPage.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Success page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="content">
    <h1>SUCCESS</h1>
    <div>
        Your information have been successfully saved.
        <?php
        if (isset($_SESSION[INFO_FILE_NAME])) {
            $content=readFormatDataFromFile($_SESSION[INFO_FILE_NAME]);
            $detailsArray=decodeFile($content);
        }
        ?>
    </div>
    <div>
        <table class="table table-sm">
            <tbody>
            <tr class="table-success">
                <th scope="row">1</th>
                <td>Image title</td>
                <td><?php echo $detailsArray[IMAGE_TITLE]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">2</th>
                <td>Image description</td>
                <td><?php echo $detailsArray[IMAGE_DESCR]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">3</th>
                <td>Artist's name</td>
                <td><?php echo $detailsArray[ARTIST_NAME]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">4</th>
                <td>Artist's email</td>
                <td><?php echo $detailsArray[ARTIST_EMAIL]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">5</th>
                <td>Camera specifications</td>
                <td><?php echo $detailsArray[CAMERA_SPECS]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">6</th>
                <td>Image price</td>
                <td><?php echo $detailsArray[PRICE_IMAGE].$detailsArray[CURRENCY]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">7</th>
                <td>Capture date</td>
                <td><?php echo $detailsArray[DATE]?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">8</th>
                <td>Tags</td>
                <td><?php echo implode(';',$detailsArray[TAG]);?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div align="center">
        <img src="<?php  echo getFolderPath($_SESSION[INFO_FILE_NAME]).$detailsArray[IMAGE_NAME];?>" height="500" width="500">
    </div>


    </form>
</div>


</body>
</html>

