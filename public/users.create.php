<?php
/* TODO:
1) Require a model that will create a new user in the database UNLESS the email or username is already taken
2) Set up a session
3) Redirect to the profile page if the user is already logged in
4) Send user either to the home page or to the profile page upon successful submission.
*/
?>
<!DOCTYPE html>
<!-- Carried over from the index -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up!</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/reagan.css">
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>
    <h2 class = "signuphead">Welcome to the ZTR Industries Ad-Lister!</h2>
    <h3 class = "signuphead">Please enter an email address, username, and password!</h3>

<!-- The signup form -->
    <form class = "signuphead" method = "POST" action = "users.create.php">
    <!-- Email -->
        <p id = "em">
            <label for "signupemail">Email</label>
            <input type = "text" name = "signupemail" id = "signupemail">
        </p>
    <!-- Username -->
        <p>
            <label for "username">Username</label>
            <input type = "text" name = "username" id = "username">
        </p>
    <!-- Password -->
        <p>
            <label for "password">Password</label>
            <input type = "password" name = "password" id = "password">
        </p>
    <!-- Confirm Password -->
        <p id = "confirm1">
            <label for "confirmpassword">Confirm Password</label>
            <input type = "password" name = "confirmpassword" id = "confirmpassword">
        </p>
    <!-- Box Color -->
        <p id = "select">
            <label for "boxcolor">What color do you want your box to be?</label>
            <select id = "boxcolor" name = "boxcolor">
                <option selected disabled>Select a Color</option>
                <option value = "red">Red</option>
                <option value = "orange">Orange</option>
                <option value = "yellow">Yellow</option>
                <option value = "green">Green</option>
                <option value = "blue">Blue</option>
                <option value = "purple">Purple</option>
                <option value = "brown">Brown</option>
                <option value = "black">Black</option>
                <option value = "papayawhip">Papayawhip</option>
                <option value = "salmon">Salmon</option>
                <option value = "burlywood">Burlywood</option>
            </select>
        </p>
        <button class = "btn btn-primary" type = "submit" value = "Sign Up!">Sign Up!</button>
    </form>

    <?php require_once '../views/footer.php'; ?>
