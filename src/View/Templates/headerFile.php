<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artists-book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/product/showProducts">Artists-book</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION[\MyApp\Model\Helper\Form\UserField::getId()])) :
            ?>
            <li><a href="/user/profile">MyProfile</a></li>
            <li><a href="/user/logout">Logout</a></li>
            <?php else :?>
            <li><a href="/user/loginPage">Login</a></li>
            <?php endif; ?>

        </ul>
    </div>
</nav>