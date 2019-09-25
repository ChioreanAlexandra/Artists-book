
<div class="content">
    <h1>Register page</h1>

    <form action="/user/register" method="POST">
        <label for="name">Name</label><br/>
        <input id="name" type="text" placeholder="Enter name" name="name"/><br/>
        <label  style="color: red"><?php if (isset($error['name'])) echo $error['name']?></label>
        <br/>
        <label for="email">Email</label><br/>
        <input id="email" type="text" placeholder="Enter email" name="email"/><br/>
        <label  style="color: red"><?php if (isset($error['email'])) echo $error['email']?></label>
        <br/>
        <label for="password">Password</label><br/>
        <input id="password" type="password" placeholder="Enter password" name="password"/><br/>
        <label  style="color: red"><?php if (isset($error['password'])) echo $error['password']?></label>
        <br>
        <input class="btn btn-primary" type="submit" value="Register">
        <br>
        <label  style="color: red"><?php if (isset($error['emptyFields'])) echo $error['emptyFields']?></label>
        <label  style="color: red"><?php if (isset($error['length'])) echo $error['length']?></label>
    </form>

</div>

<div style="clear: both;"></div>
</div>

</div>
