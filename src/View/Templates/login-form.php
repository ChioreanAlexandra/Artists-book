
<div class="content">
    <h1>LOGIN page</h1>

    <form action="/user/login" method="POST">
        <label for="user">Email</label><br/>
        <input id="user" type="text" placeholder="Enter email" name="email"/><br/>
        <label  style="color: red"><?php if (isset($errors['email'])) echo $errors['email']?></label><br/>
        <label for="password">Password</label><br/>
        <input id="password" type="password" placeholder="Enter password" name="password"/>
        <div style="color: red">
        </div>
        <input class="btn btn-primary" type="submit" value="Login">

    </form>
    <label style="color: red"><?php if(isset($errors['error']))echo $errors['error'];?></label>
    <label style="color: red"><?php if(isset($errors['emptyFields']))echo $errors['emptyFields'];?></label>
    <br>
    <a class="btn btn-primary" href="/user/registerPage" role="button">Register</a>


</div>

<div style="clear: both;"></div>
</div>

</div>

