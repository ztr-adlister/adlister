<?php
/* TODO:
1) Require a model that will create a new user in the database UNLESS the email or username is already taken
2) Set up a session
3) Redirect to the profile page if the user is already logged in
4) Send user either to the home page or to the profile page upon successful submission.
*/
require_once '../utils/Input.php';
require_once '../utils/Auth.php';
require_once '../models/User.php';
require_once '../models/Basemodel.php';
session_start();
if (Auth::check()) {
    header('location: users.show.php');
    die();
}
$loginstatus = "Members, Log In!";
$newuser = new User;
$newuser->email = Input::get('signupemail');
$newuser->username = Input::get('username');
$newuser->password = Input::get('password');
$newuser->boxcolor = Input::get('boxcolor');
if($newuser->email != null) {
    if($newuser->username != null) {
        if($newuser->password != null) {
            if($newuser->password == Input::get('confirmpassword')) {
                $newuser->password = password_hash($newuser->password, PASSWORD_DEFAULT);
                $newuser->save();
                header('location: users.show.php');
                die();
            } 
        } 
    } 
} 
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
            <input type = "text" name = "signupemail" id = "signupemail" required>
        </p>
    <!-- Username -->
        <p>
            <label for "username">Username</label>
            <input type = "text" name = "username" id = "username" required>
        </p>
    <!-- Password -->
        <p>
            <label for "password">Password</label>
            <input type = "password" name = "password" id = "password" required>
        </p>
    <!-- Confirm Password -->
        <p id = "confirm1">
            <label for "confirmpassword">Confirm Password</label>
            <input type = "password" name = "confirmpassword" id = "confirmpassword" required>
        </p>
    <!-- Box Color -->
        <p id = "select">
            <label for "boxcolor">What color do you want your box to be?</label>
            <select id = "boxcolor" name = "boxcolor" required>
                <option id = "red">Red</option>
                <option id = "orange">Orange</option>
                <option id = "yellow">Yellow</option>
                <option id = "green">Green</option>
                <option id = "blue">Blue</option>
                <option id = "purple">Purple</option>
                <option id = "brown">Brown</option>
                <option id = "black">Black</option>
                <option id = "gray">Gray</option>
                <option id = "papayawhip">Papayawhip</option>
                <option id = "salmon">Salmon</option>
                <option id = "burlywood">Burlywood</option>
                <option id = "skyblue">Sky Blue</option>
                <option id = "chartreuse">Chartreuse</option>
                <option id = "darkmagenta">Dark Magenta</option>
                <option id = "tomato">Tomato</option>
                <option id = "turquoise">Turquoise</option>
                <option id = "yellowgreen">Yellow Green</option>
                <option id = "teal">Teal</option>
                <option id = "goldenrod">Goldenrod</option>
                <option id = "gold">Gold</option>
            </select>
        </p>
        <button class = "btn btn-primary" type = "submit" value = "Sign Up!">Sign Up!</button>
    </form>
    <?php require_once '../views/footer.php'; ?>
