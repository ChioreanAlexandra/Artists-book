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
        <br/>
        <label for="password">Password</label><br/>
        <input id="password" type="password" placeholder="Enter password" name="password"/>
        <div style="color: red">
        </div>
        <input type="submit" value="Login">
        <?php if(isset($errors['error']))echo $errors['error'];?>
    </form>
    <a href="/user/registerPage" >Register</a>

</div>

<div style="clear: both;"></div>
</div>

</div>

