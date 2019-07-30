<!DOCTYPE html>
<html lang="en">
<head>
    <title>HOME</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Image Gallery</h2>

    <div class="row">
        <?php foreach ($productList as $product):?>
        <div class="col-md-4">
            <div class="thumbnail">
                <
                    <a href="/product/showProduct">
                    <img src=<?php echo $product->getThumbnailPath();?> alt="Lights" style="width:100%">
                    <div class="caption">
                        <p><?php echo $product->getTitle();?></p>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>


