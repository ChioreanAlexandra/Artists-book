<?php
use \MyApp\Model\Helper\Form\UserField;
?>

<div class="content">
    <h1>LOGIN page</h1>

    <form action="/user/login" method="POST">
        <label for="user">Email</label><br/>
        <input id="user" type="text" placeholder="Enter email" name="email"/>
        <div style="color: red">
        </div>
        <br/>
        <label for="password">Password</label><br/>
        <input id="password" type="password" placeholder="Enter password" name="password"/>
        <div style="color: red">
        </div>
        <input class="btn btn-primary" type="submit" value="Login">

    </form>
    <label style="color: red"><?php if(isset($errors['error']))echo $errors['error'];?></label><br/>
    <br>
    <a class="btn btn-primary" href="/user/registerPage" role="button">Register</a>


</div>

<div style="clear: both;"></div>
</div>

</div>

