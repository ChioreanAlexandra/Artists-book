<?php

ini_set('display_errors', 'ON');
$errors = [];


?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Admin homepage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>
<div id="wrapper">
    <div id="header">
        Header
    </div>

    <div class="container">
        <div class="left-menu">
            <div class="main-menu">
                <ul>
                    <li><a href="/admin/">Homepage</a></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <h1>Homepage</h1>

            <?php if (isset($_POST) && $errors) {?>
                <div style="color: red"><?php echo implode(',', $errors) ?></div>
            <?php } ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="first_name">First name</label><br />
                <input id="first_name" type="text" value="" name="firstName" />

                <br />
                <label for="last_name">Last name</label><br />
                <input id="last_name" type="text" value="" name="lastName" />

                <br />
                <label for="email">Email</label><br />
                <input id="email" type="text" value="" name="email" />

                <br />
                <br />
                College:
                <input type="checkbox" name="college">
                <Br />
                <Br />
                <Br />

                

                Image 1 <br />
                <br />
                <input type="file" name="image1" />

                Image  2<br />
                <br />
                <input type="file" multiple="multiple" name="image2" />
                <input type="submit" value="Salveaza profil" />
            </form>
        </div>

        <div style="clear: both;"></div>
    </div>

    <div id="footer">
        Footer
    </div>
</div>

</body>
</html>
