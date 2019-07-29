<?php
use \MyApp\Model\Helper\Form\UserField;
?>
<!DOCTYPE html>
<html>
<head>
    <title>LOGIN page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="content">
    <h1>LOGIN page</h1>

    <form action="/user/login" method="POST">
        <label for="user">Email</label><br/>
        <input id="user" type="text" placeholder="Enter email" name="email"/>
        <div style="color: red">
            <?php if(isset($errors[UserField::getEmailField()]))echo $errors[UserField::getEmailField()];?>
        </div>
        <br/>
        <br/>
        <label for="password">Password</label><br/>
        <input id="password" type="password" placeholder="Enter password" name="password"/>
        <div style="color: red">
            <?php if(isset($errors[UserField::getPasswordField()]))echo $errors[UserField::getPasswordField()];?>
        </div>
        <input type="submit" value="Login">
    </form>
    <a href="/user/registerPage" >Register</a>

</div>

<div style="clear: both;"></div>
</div>

</div>

</body>
</html>
