<?php
require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';
require_once '../models/Basemodel.php';
require_once '../models/User.php';
require_once '../utils/Auth.php';
require_once '../utils/Input.php';
session_start();
User::dbConnect();
$loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
$stmt = $dbc->prepare('SELECT * FROM users WHERE username = :username');
$stmt->bindValue(':username', $_SESSION['Loggedinuser']);
$stmt->execute();
$userdata = $stmt->fetch(PDO::FETCH_ASSOC);

$email = Input::get('updatemail') ? Input::get('updatemail') : $userdata['email'];
$username = Input::get('updatename') ? Input::get('updatename') : $userdata['username'];
$password = Input::get('updatepassword') ? Input::get('updatepassword') : $userdata['password'];
$boxcolor = Input::get('boxcolor') ? Input::get('boxcolor') : $userdata['boxcolor'];
$icon = Input::get('icontype') ? Input::get('icontype') : $userdata['icon'];
$confirmpassword = Input::get('updateconfirm') ? Input::get('updateconfirm') : "";
$message = "";
$newuser = User::find($userdata['id']);
$newuser->email = $email;
$newuser->username = $username;
$newuser->password = $password;
$newuser->boxcolor = $boxcolor;
$newuser->icon = $icon;
if($newuser->email != null) {
    if($newuser->username != null) {
        if($newuser->password != null) {
            if($newuser->password == $confirmpassword && $confirmpassword != null) {
                $newuser->password = password_hash($newuser->password, PASSWORD_DEFAULT);
                $newuser->save();
                $_SESSION['Loggedinuser'] = $newuser->username;
                // $userdata['email'] = $email;
                // $userdata['username'] = $username;
                // $userdata['password'] = $password;
                header('location: users.show.php');
                die();
            } 
        } 
    } 
} 

Auth::attempt($username, $password);
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}
?>
<!DOCTYPE html>
<!-- Carried over from the index -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit your profile</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="css/reagan.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">
    </head>
    <body>
    	<?php require_once '../views/navbar.php'; ?>
        <!-- Puts text below the navbar -->
    	<br><br><br><br>
        <h5 class = "edit">Enter new information below (If you do not want to update a certain field, enter your old information in it)</h5>
        <div class = "error"><?=$message?></div>
    <!-- The edit form -->
    	<form class = "edit" method = "POST" action = "users.edit.php">
        <!-- Update Email -->
    		<p id = "em">
    			<label for "updatemail">Email</label>
    			<input type = "text"  name = "updatemail" id = "updatemail" value = "<?=$userdata['email'];?>" required>
    		</p>
        <!-- Update Username -->
    		<p>
    			<label for "updatename">Username</label>
    			<input type = "text" name = "updatename" id = "updatename" value = "<?=$username?>" required>
    		</p>
        <!-- Update Password -->
    		<p>
    			<label for "updatepassword">Password</label>
    			<input type ="password" name = "updatepassword" id = "updatepassword" required>
    		</p>
        <!-- Confirm Updated Password -->
    		<p id = "confirm1">
    			<label for "updateconfirm">Confirm Password</label>
    			<input type = "password" name = "updateconfirm" id = "updateconfirm" required>
    		</p>
        <!-- Update Box Color -->
            <p>
                <label for "updatebox">Box Color</label>
                <select id = "boxcolor" name = "boxcolor">
                    <option id = "red"<?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Red</option>
                    <option id = "orange" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Orange</option>
                    <option id = "yellow" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Yellow</option>
                    <option id = "green" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Green</option>
                    <option id = "blue" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Blue</option>
                    <option id = "purple" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Purple</option>
                    <option id = "brown" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Brown</option>
                    <option id = "gray" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Gray</option>
                    <option id = "papayawhip" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Papayawhip</option>
                    <option id = "salmon" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Salmon</option>
                    <option id = "burlywood" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Burlywood</option>
                    <option id = "skyblue" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Skyblue</option>
                    <option id = "chartreuse" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Chartreuse</option>
                    <option id = "darkmagenta" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Darkmagenta</option>
                    <option id = "tomato" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Tomato</option>
                    <option id = "turquoise" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Turquoise</option>
                    <option id = "yellowgreen" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Yellowgreen</option>
                    <option id = "teal" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Teal</option>
                    <option id = "goldenrod" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Goldenrod</option>
                    <option id = "gold" <?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Gold</option>
                </select>
            </p>
            <p id = "select">
                <label for "icontype">What icon do you want to represent you?</label>
                <select id = "icontype" name = "icontype" required>
                    <option>university</option>
                    <option>beer</option>
                    <option>bug</option>
                    <option>bullseye</option>
                    <option>car</option>
                    <option>anchor</option>
                    <option>bomb</option>
                    <option>birthday-cake</option>
                    <option>bed</option>
                    <option>diamond</option>
                    <option>female</option>
                    <option>male</option>
                    <option>plane</option>
                    <option>paper-plane</option>
                </select>
            </p>
    		<button class = "btn btn-primary" type = "submit" value = "submit"><i class = "fa fa-check"></i>Update</button>
    	</form>
            <a id = "cancel" href="users.show.php"><i class = "fa fa-times"></i>Cancel</a>
        
    </body>
     <?php require_once '../views/footer.php'; ?>