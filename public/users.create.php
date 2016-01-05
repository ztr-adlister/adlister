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
$newuser->phone = Input::get('signupphone');
$newuser->username = Input::get('username');
$newuser->password = Input::get('password');
$newuser->reminder = Input::get('reminder');
$newuser->boxcolor = Input::get('boxcolor');
$newuser->icon = Input::get('icontype');

$receiver = Input::get('emailer');
$receivedmessage = Input::get('comment');

$usercheck = User::finduserbyusername($newuser->username);
$emailcheck = User::checkemail($newuser->email);

if($newuser->email != null) {
    if($newuser->phone != null) {
        if($newuser->username != null) {
            if($newuser->password != null) {
                if($newuser->password == Input::get('confirmpassword')) {
                    if(empty($usercheck)) {
                        if(empty($emailcheck)) {
                            $newuser->password = password_hash($newuser->password, PASSWORD_DEFAULT);
                            $newuser->save();
                            $receiver = $newuser->email;
                            $receivedmessage = "Hello, $newuser->username!\nWelcome to Spatula City! This email is to let you know that you have successfully been registered in our database, and it also serves as a way to test our brand new emailing system!\nWe hope you enjoy your Spatula shopping experience!\n-Reagan Wilkins, Anthony Burns, and Zeshan Segal.";
                            // $to = $_POST['signupemail'];
                            // $subject = "Welcome to Spatula City!";
                            // $emmessage = wordwrap("Greetings, " . $newuser->username . ",\r\nWelcome to Spatula City, the web's premium advertisement listing forum by Reagan Wilkins, Tony Burns, and Zeshan Segal! At this time you will not be able to log in, as the site is still in testing. This was merely a test of Reagan Wilkins's email code!\r\nHave a pleasant day!\r\n-Reagan Wilkins, Tony Burns, and Zeshan Segal.", 70, "\r\n");
                            // $type = 'plain'; // or HTML
                            // $charset = 'utf-8';
                            // $headers = "From: ZTR-Adlister" . "\r\n";
                            // $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            // $headers .= "MIME-Version: 1.0" . "\r\n";
                            // $email = mail($to, $subject, $emmessage, $headers);
                            // $message = $email;
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
}
?>
<!DOCTYPE html>
<!-- Carried over from the index -->
<html lang="en">
   <?php require_once '../views/header.php'; ?>
    <body class = "meetColor">
        <?php require_once '../views/navbar.php'; ?>
<div class = "row">
    <div class = "col-md-6 col-md-offset-3">
        <h2 class = "signuphead textinfrontofbackground">Welcome to Spatula City!</h2>
        <h3 class = "signuphead textinfrontofbackground">Please enter the following information</h3>
        <div class = "error"><?=$message;?></div>
    <!-- The signup form -->
        <form class = "signuphead form-horizontal" method = "POST" action = "users.create.php">
        <!-- Email -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label" for "signupemail">Email</label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "text" name = "signupemail" id = "signupemail" value = "<?=$newuser->email?>" required>
                </div>
            </p>
        </div>
        <!-- Phone Number -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label" for "signupphone">Phone Number</label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "text" name = "signupphone" id = "signupphone" value = "<?=$newuser->phone?>" required>
                </div>
            </p>
        </div>
        <!-- Username -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label" for "username">Username</label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "text" name = "username" id = "username" value = "<?=$newuser->username?>" required>
                </div>
            </p>
        </div>
        <!-- Password -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label" for "password">Password</label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "password" name = "password" id = "password" required>
                </div>
            </p>
        </div>
        <!-- Confirm Password -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label" for "confirmpassword">Confirm Password</label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "password" name = "confirmpassword" id = "confirmpassword" required>
                </div>
            </p>
        </div>
            <!-- Reminder -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label hidden-xs hidden-sm" for "reminder">Write a reminder for your password (i.e. My dog's name, my first nickname, etc.): </label>
                <label class = "textinfrontofbackground col-sm-5 control-label hidden-md hidden-lg" for "reminder">Reminder: </label>
                <div class = "col-sm-6">
                <input class = "form-control" type = "text" id = "reminder" name = "reminder" required>
                </div>
            </p>
        </div>
        <!-- Box Color -->
        <div class = "form-group">
            <p>
                <label class = "textinfrontofbackground col-sm-5 control-label hidden-xs hidden-sm" for "boxcolor">What color do you want your box to be?</label>
                <label class = "textinfrontofbackground col-sm-5 control-label hidden-md hidden-lg" for "boxcolor">Box Color</label>
                <div class = "col-sm-6">
                <select class = "form-control" id = "boxcolor" name = "boxcolor" required>
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
                </div>
        </div>
        <div class = "form-group">
            </p>
            <p>
                <label class = "textinfrontofbackground col-sm-5 hidden-xs hidden-sm control-label" for "icontype">What icon do you want to represent you?</label>
                <label class = "textinfrontofbackground col-sm-5 hidden-md hidden-lg control-label" for "icontype">Icon</label>
                <div class = "col-sm-6">
                <select class = "form-control" id = "icontype" name = "icontype" required>
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
                    <option <?php if($newuser->icon == "eye") {?>selected<?php }?>>eye</option>
                    <option <?php if($newuser->icon == "paw") {?>selected<?php }?>>paw</option>
                    <option <?php if($newuser->icon == "spoon") {?>selected<?php }?>>spoon</option>
                    <option <?php if($newuser->icon == "cloud") {?>selected<?php }?>>cloud</option>
                    <option <?php if($newuser->icon == "home") {?>selected<?php }?>>home</option>
                    <option <?php if($newuser->icon == "rocket") {?>selected<?php }?>>rocket</option>
                    <option <?php if($newuser->icon == "ship") {?>selected<?php }?>>ship</option>
                    <option <?php if($newuser->icon == "road") {?>selected<?php }?>>road</option>
                    <option <?php if($newuser->icon == "shield") {?>selected<?php }?>>shield</option>
                    <option <?php if($newuser->icon == "star") {?>selected<?php }?>>star</option>
                    <option <?php if($newuser->icon == "plug") {?>selected<?php }?>>plug</option>
                    <option <?php if($newuser->icon == "money") {?>selected<?php }?>>money</option>
                    <option <?php if($newuser->icon == "money") {?>selected<?php }?>>music</option>
                    <option <?php if($newuser->icon == "magnet") {?>selected<?php }?>>magnet</option>
                    <option <?php if($newuser->icon == "magic") {?>selected<?php }?>>magic</option>
                    <option <?php if($newuser->icon == "graduation-cap") {?>selected<?php }?>>graduation-cap</option>
                    <option <?php if($newuser->icon == "bell") {?>selected<?php }?>>bell</option>
                    <option <?php if($newuser->icon == "bicycle") {?>selected<?php }?>>bicycle</option>
                    <option <?php if($newuser->icon == "code") {?>selected<?php }?>>code</option>
                    <option <?php if($newuser->icon == "building") {?>selected<?php }?>>building</option>
                    <option <?php if($newuser->icon == "barcode") {?>selected<?php }?>>barcode</option>
                    <option <?php if($newuser->icon == "database") {?>selected<?php }?>>database</option>
                    <option <?php if($newuser->icon == "flag") {?>selected<?php }?>>flag</option>
                    <option <?php if($newuser->icon == "flask") {?>selected<?php }?>>flask</option>
                    <option <?php if($newuser->icon == "gavel") {?>selected<?php }?>>gavel</option>
                    <option <?php if($newuser->icon == "glass") {?>selected<?php }?>>glass</option>
                    <option <?php if($newuser->icon == "heart") {?>selected<?php }?>>heart</option>
                    <option <?php if($newuser->icon == "key") {?>selected<?php }?>>key</option>
                    <option <?php if($newuser->icon == "leaf") {?>selected<?php }?>>leaf</option>
                    <option <?php if($newuser->icon == "gift") {?>selected<?php }?>>gift</option>
                    <option <?php if($newuser->icon == "gamepad") {?>selected<?php }?>>gamepad</option>
                    <option <?php if($newuser->icon == "ticket") {?>selected<?php }?>>ticket</option>
                    <option <?php if($newuser->icon == "truck") {?>selected<?php }?>>truck</option>
                    <option <?php if($newuser->icon == "thumbs-up") {?>selected<?php }?>>thumbs-up</option>
                    <option <?php if($newuser->icon == "tree") {?>selected<?php }?>>tree</option>
                    <option <?php if($newuser->icon == "trophy") {?>selected<?php }?>>trophy</option>
                    <option <?php if($newuser->icon == "umbrella") {?>selected<?php }?>>umbrella</option>
                    <option <?php if($newuser->icon == "coffee") {?>selected<?php }?>>coffee</option>
                </select>
                </div>
        </div>
            </p>
            <button id = "thebutton" class = "btn btn-primary" type = "submit" value = "Sign Up!"><i class = "fa fa-user-plus"></i>Sign Up!</button>
        </form>
    </div>
</div>
<form method="POST" id = "emailingform" action = "https://www.elformo.com/forms/2bdd1799-5bea-4cf0-8fac-6fec5c2e5b9c">
    <input type = "hidden" name = "emailer" id="emailer">
    <textarea type = "hidden" style = "display:none" name = "comment" id="comment"></textarea>
</form>
<br>
    <?php require_once '../views/footer.php'; ?>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script>
    "Use Strict";
    $("#thebutton").click(function() {
        var emailaddress = $('#emailer');
        var emailmessage = $('#comment');
        $("#emailingform").submit();
    });
    // </script>
