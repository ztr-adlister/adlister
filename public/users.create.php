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
$message = '';
$loginstatus = "Members, Log In!";
$newuser = new User;
$newuser->email = Input::get('signupemail');
$newuser->username = Input::get('username');
$newuser->password = Input::get('password');
$newuser->boxcolor = Input::get('boxcolor');
$newuser->icon = Input::get('icontype');

$usercheck = User::finduserbyusername($newuser->username);
$emailcheck = User::checkemail($newuser->email);

if($newuser->email != null) {
    if($newuser->username != null) {
        if($newuser->password != null) {
            if($newuser->password == Input::get('confirmpassword')) {
                if(empty($usercheck)) {
                    if(empty($emailcheck)) {
                        $newuser->password = password_hash($newuser->password, PASSWORD_DEFAULT);
                        $newuser->save();
                        // $to = $newuser->email;
                        // $subject = "Welcome to ZTR-Adlister!";
                        // $message = wordwrap("Greetings, " . $newuser->username . ",\r\nWelcome to ZTR-Adlister, the web's premium advertisement listing forum by Reagan Wilkins, Tony Burns, and Zeshan Segal! At this time you will not be able to log in, as the site is still in testing. This was merely a test of Reagan Wilkins's email code!\r\nHave a pleasant day!\r\n-Reagan Wilkins, Tony Burns, and Zeshan Segal.", 70, "\r\n");
                        // mail($to, $subject, $message);
                        header('location: users.show.php');
                        die(); 
                    } else {
                        $message = "This email is already taken"; 
                    }
                } else {
                    $message = "This username is already taken";
                }
            } else {
                $message = "Your passwords do not match";
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
    <div class = "error"><?=$message;?></div>
<!-- The signup form -->
    <form class = "signuphead" method = "POST" action = "users.create.php">
    <!-- Email -->
        <p id = "em">
            <label for "signupemail">Email</label>
            <input type = "text" name = "signupemail" id = "signupemail" value = "<?=$newuser->email?>" required>
        </p>
    <!-- Username -->
        <p>
            <label for "username">Username</label>
            <input type = "text" name = "username" id = "username" value = "<?=$newuser->username?>" required>
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
                <!-- Red -->
                <option id = "red"<?php if($newuser->boxcolor == "Red") {?>selected<?php }?>>Red</option>
                <!-- Orange -->
                <option id = "orange"<?php if($newuser->boxcolor == "Orange") {?>selected<?php }?>>Orange</option>
                <!-- Yellow -->
                <option id = "yellow"<?php if($newuser->boxcolor == "Yellow") {?>selected<?php }?>>Yellow</option>
                <!-- Green -->
                <option id = "green"<?php if($newuser->boxcolor == "Green") {?>selected<?php }?>>Green</option>
                <!-- Blue -->
                <option id = "blue"<?php if($newuser->boxcolor == "Blue") {?>selected<?php }?>>Blue</option>
                <!-- Purple -->
                <option id = "purple"<?php if($newuser->boxcolor == "Purple") {?>selected<?php }?>>Purple</option>
                <!-- Brown -->
                <option id = "brown"<?php if($newuser->boxcolor == "Brown") {?>selected<?php }?>>Brown</option>
                <!-- Gray -->
                <option id = "gray"<?php if($newuser->boxcolor == "Gray") {?>selected<?php }?>>Gray</option>
                <!-- Papayawhip -->
                <option id = "papayawhip"<?php if($newuser->boxcolor == "Papayawhip") {?>selected<?php }?>>Papayawhip</option>
                <!-- Salmon -->
                <option id = "salmon"<?php if($newuser->boxcolor == "Salmon") {?>selected<?php }?>>Salmon</option>
                <!-- Burlywood -->
                <option id = "burlywood"<?php if($newuser->boxcolor == "Burlywood") {?>selected<?php }?>>Burlywood</option>
                <!-- Skyblue -->
                <option id = "skyblue"<?php if($newuser->boxcolor == "Skyblue") {?>selected<?php }?>>Skyblue</option>
                <!-- Chartreuse -->
                <option id = "chartreuse"<?php if($newuser->boxcolor == "Chartreuse") {?>selected<?php }?>>Chartreuse</option>
                <!-- Darkmagenta -->
                <option id = "darkmagenta"<?php if($newuser->boxcolor == "Darkmagenta") {?>selected<?php }?>>Darkmagenta</option>
                <!-- Tomato -->
                <option id = "tomato"<?php if($newuser->boxcolor == "Tomato") {?>selected<?php }?>>Tomato</option>
                <!-- Turquoise -->
                <option id = "turquoise"<?php if($newuser->boxcolor == "Turquoise") {?>selected<?php }?>>Turquoise</option>
                <!-- Yellowgreen -->
                <option id = "yellowgreen"<?php if($newuser->boxcolor == "Yellowgreen") {?>selected<?php }?>>Yellowgreen</option>
                <!-- Teal -->
                <option id = "teal"<?php if($newuser->boxcolor == "Teal") {?>selected<?php }?>>Teal</option>
                <!-- Goldenrod -->
                <option id = "goldenrod"<?php if($newuser->boxcolor == "Goldenrod") {?>selected<?php }?>>Goldenrod</option>
                <!-- Gold -->
                <option id = "gold"<?php if($newuser->boxcolor == "Gold") {?>selected<?php }?>>Gold</option>
            </select>
        </p>
        <p id = "select">
            <label for "icontype">What icon do you want to represent you?</label>
            <select id = "icontype" name = "icontype" required>
                <option <?php if($newuser->icon == "university") {?>selected<?php }?>>university</option>
                <option<?php if($newuser->icon == "beer") {?>selected<?php }?>>beer</option>
                <option <?php if($newuser->icon == "bug") {?>selected<?php }?>>bug</option>
                <option <?php if($newuser->icon == "bullseye") {?>selected<?php }?>>bullseye</option>
                <option <?php if($newuser->icon == "car") {?>selected<?php }?>>car</option>
                <option <?php if($newuser->icon == "anchor") {?>selected<?php }?>>anchor</option>
                <option <?php if($newuser->icon == "bomb") {?>selected<?php }?>>bomb</option>
                <option <?php if($newuser->icon == "birthday-cake") {?>selected<?php }?>>birthday-cake</option>
                <option <?php if($newuser->icon == "bed") {?>selected<?php }?>>bed</option>
                <option <?php if($newuser->icon == "diamond") {?>selected<?php }?>>diamond</option>
                <option <?php if($newuser->icon == "female") {?>selected<?php }?>>female</option>
                <option <?php if($newuser->icon == "male") {?>selected<?php }?>>male</option>
                <option <?php if($newuser->icon == "plane") {?>selected<?php }?>>plane</option>
                <option <?php if($newuser->icon == "paper-plane") {?>selected<?php }?>>paper-plane</option>
                <option<?php if($newuser->icon == "eye") {?>selected<?php }?>>eye</option>
                <option<?php if($newuser->icon == "paw") {?>selected<?php }?>>paw</option>
                <option<?php if($newuser->icon == "spoon") {?>selected<?php }?>>spoon</option>
                <option<?php if($newuser->icon == "cloud") {?>selected<?php }?>>cloud</option>
                <option<?php if($newuser->icon == "home") {?>selected<?php }?>>home</option>
                <option<?php if($newuser->icon == "rocket") {?>selected<?php }?>>rocket</option>
                <option<?php if($newuser->icon == "ship") {?>selected<?php }?>>ship</option>
                <option<?php if($newuser->icon == "road") {?>selected<?php }?>>road</option>
                <option<?php if($newuser->icon == "shield") {?>selected<?php }?>>shield</option>
                <option<?php if($newuser->icon == "star") {?>selected<?php }?>>star</option>
                <option<?php if($newuser->icon == "plug") {?>selected<?php }?>>plug</option>
                <option<?php if($newuser->icon == "money") {?>selected<?php }?>>money</option>
                <option<?php if($newuser->icon == "money") {?>selected<?php }?>>music</option>
                <option<?php if($newuser->icon == "magnet") {?>selected<?php }?>>magnet</option>
                <option<?php if($newuser->icon == "magic") {?>selected<?php }?>>magic</option>
                <option<?php if($newuser->icon == "graduation-cap") {?>selected<?php }?>>graduation-cap</option>
                <option<?php if($newuser->icon == "bell") {?>selected<?php }?>>bell</option>
                <option<?php if($newuser->icon == "bicycle") {?>selected<?php }?>>bicycle</option>
                <option<?php if($newuser->icon == "code") {?>selected<?php }?>>code</option>
                <option<?php if($newuser->icon == "building") {?>selected<?php }?>>building</option>
                <option<?php if($newuser->icon == "barcode") {?>selected<?php }?>>barcode</option>
                <option<?php if($newuser->icon == "database") {?>selected<?php }?>>database</option>
                <option<?php if($newuser->icon == "flag") {?>selected<?php }?>>flag</option>
                <option<?php if($newuser->icon == "flask") {?>selected<?php }?>>flask</option>
                <option<?php if($newuser->icon == "gavel") {?>selected<?php }?>>gavel</option>
                <option<?php if($newuser->icon == "glass") {?>selected<?php }?>>glass</option>
                <option<?php if($newuser->icon == "heart") {?>selected<?php }?>>heart</option>
                <option<?php if($newuser->icon == "key") {?>selected<?php }?>>key</option>
                <option<?php if($newuser->icon == "leaf") {?>selected<?php }?>>leaf</option>
                <option<?php if($newuser->icon == "gift") {?>selected<?php }?>>gift</option>
                <option<?php if($newuser->icon == "gamepad") {?>selected<?php }?>>gamepad</option>
                <option<?php if($newuser->icon == "ticket") {?>selected<?php }?>>ticket</option>
                <option<?php if($newuser->icon == "truck") {?>selected<?php }?>>truck</option>
                <option<?php if($newuser->icon == "thumbs-up") {?>selected<?php }?>>thumbs-up</option>
                <option<?php if($newuser->icon == "tree") {?>selected<?php }?>>tree</option>
                <option<?php if($newuser->icon == "trophy") {?>selected<?php }?>>trophy</option>
                <option<?php if($newuser->icon == "umbrella") {?>selected<?php }?>>umbrella</option>
                <option<?php if($newuser->icon == "coffee") {?>selected<?php }?>>coffee</option>
            </select>
        </p>
        <button class = "btn btn-primary" type = "submit" value = "Sign Up!">Sign Up!</button>
    </form>
    <?php require_once '../views/footer.php'; ?>
