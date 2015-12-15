<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up!</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <style>
        .signuphead {
            text-align: center;
            margin-top: 60px;
        }
    </style>
    <body>
        <?php require_once '../views/navbar.php'; ?>
    <h2 class = "signuphead">Welcome to ZTR Industries!</h2>
    <h3 class = "signuphead">Please enter an email address, username, and password!</h3>
    <form class = "signuphead">
        <p>
            <label for "signupemail">Email</label>
            <input type = "text" name = "signupemail" id = "signupemail">
        </p>
        <p>
            <label for "username">Username</label>
            <input type = "text" name = "username" id = "username">
        </p>
        <p>
            <label for "password">Password</label>
            <input type = "text" name = "password" id = "password">
        </p>
        <p>
            <label for "confirmpassword">Confirm Password</label>
            <input type = "text" name = "confirmpassword" id = "confirmpassword">
        </p>
        <button type = "submit" value = "Sign Up!">Sign Up!</button>
    </form>

    <?php require_once '../views/footer.php'; ?>
