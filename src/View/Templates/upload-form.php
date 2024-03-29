<?php

?>

<div class="content">
    <h1>Upload image</h1>
    <form action="/product/uploadProduct" method=POST enctype="multipart/form-data">
        <label for="imageTitle">Image title</label><br/>
        <input id="imageTitle" type="text" placeholder="Enter the image title" name="title"/>

        <br/>
        <br/>
        <label for="imageDescription">Image description</label><br/>
        <input id="imageDescription" type="text" placeholder="Enter an image description" name="description"/>


        <div style="color: red">
            <?php //if(isset($errors[ARTIST_EMAIL]))echo $errors[ARTIST_EMAIL];?>
        </div>

        <br/>
        <br/>
        <label for="cameraSpecs" style="color: gainsboro">Camera specifications </label><br/>
        <input id="imageDescription" type="text" placeholder="Enter the camera specifications" name="camera_specs"/>

        <br/>
        <br/>
        <label for="imagePrice" style="color: gainsboro">Price</label><br/>
        <input id="imagePrice" type="number" placeholder="Enter large tier" name="priceLargeTier" step="0.01" min="0">
        <input id="imagePrice" type="number" placeholder="Enter medium tier" name="priceMediumTier" step="0.01" min="0">
        <input id="imagePrice" type="number" placeholder="Enter small tier" name="priceSmallTier" step="0.01" min="0">
        <label for="currency">LEI</label><br/>

        <br/>
        <div style="color: red">
            <?//php if(isset($errors[PRICE_IMAGE]))echo $errors[PRICE_IMAGE];?>
        </div>


        <br/>
        <label for="date"style="color: gainsboro">Capture date</label><br/>
        <input id="date" type="date" name="capture_data">

        <br/>

        <div style="color: red">
            <?php //if(isset($errors[DATE]))echo $errors[DATE];?>
        </div>

        <br/>
        <label for="tag[]"style="color: gainsboro">Tags</label>
        <select name="tag[]" multiple>
            <?php foreach($tags as $option):?>
            <option><?php  echo $option->getTagName();?></option>
            <?php endforeach; ?>
        </select>
        <br/>

        <div style="color: red">
            <?php //if(isset($error[TAG]))echo $errors[TAG];?>
        </div>

        <br/>


        <label for="image" style="color: gainsboro">Image to be uploaded</label> &nbsp;
        <input type="file" name="image"/>
        <br/>
        <div style="color: red">
            <?php //if(!empty($errors[IMAGE_FILE_NAME]))echo $errors[IMAGE_FILE_NAME];?>
        </div>
        <br/>
        <br/>
        <input class="btn btn-primary" type="submit" value="Update product">
        <div style="color: red">
            <?php //if(!empty($errorMessage))echo $errorMessage;?>
        </div>

    </form>
</div>

<div style="clear: both;"></div>
</div>

</div>
