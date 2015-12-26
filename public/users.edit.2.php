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
$error = "";
$success = "";
$userdata = $stmt->fetch(PDO::FETCH_ASSOC);
$choice = Input::get('updatechoice');
$newdata = Input::get('updatefield');
$boxcolor = Input::get('boxcolor') ? Input::get('boxcolor') : $userdata['boxcolor'];
$icon = Input::get('icontype') ? Input::get('icontype') : $userdata['icon'];

$updateuser = User::find($userdata['id']);
$updateuser->boxcolor = $boxcolor;
$updateuser->icon = $icon;
if($choice == "email") {
	$updateuser->email = $newdata;
	$emailcheck = User::checkemail($updateuser->email);
	if (empty($emailcheck)) {
		$updateuser->save();
		$success = "Email successfully updated";
	} else {
		$error = "This email is already taken";
	}
} else if ($choice == "username") {
	$updateuser->username = $newdata;
	$usercheck = User::finduserbyusername($updateuser->username);
	if(empty($usercheck)) {
		$updateuser->save();
		$_SESSION['Loggedinuser'] = $updateuser->username;
		$success = "Username successfully updated";
	} else {
		$error = "This username is already taken";
	}
} else if ($choice == "password") {
	$updateuser->password = password_hash($newdata, PASSWORD_DEFAULT);
	$updateuser->save();
	$success = "Password successfully updated";
}
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}
?>
<!DOCTYPE html>
<html>
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
	<br><br><br><br>
	<div class = "error"><?=$error?></div>
	<div class = "success"><?=$success?></div>
<form class = "edit" method="POST" action = "users.edit.2.php">
	<p id="select">
		<label for "updatechoice">What do you want to edit?</label>
		<select id ="updatechoice" name="updatechoice" required>
			<option>email</option>
			<option>username</option>
			<option>password</option>
		</select>
	</p>
	<p>
		<label for "updatefield">New Information: </label>
		<input type = <?php if ($choice == "password") {?> password <?php } else {?> text <?php }?> name = "updatefield" id = "updatefield" required>
	</p>
	 <p>
	        <label for "updatebox">Box Color</label>
	        <select id = "boxcolor" name = "boxcolor">
	            <option id = "red"<?php if($userdata['boxcolor'] == "Red") {?>selected<?php }?>>Red</option>
	            <option id = "orange" <?php if($userdata['boxcolor'] == "Orange") {?>selected<?php }?>>Orange</option>
	            <option id = "yellow" <?php if($userdata['boxcolor'] == "Yellow") {?>selected<?php }?>>Yellow</option>
	            <option id = "green" <?php if($userdata['boxcolor'] == "Green") {?>selected<?php }?>>Green</option>
	            <option id = "blue" <?php if($userdata['boxcolor'] == "Blue") {?>selected<?php }?>>Blue</option>
	            <option id = "purple" <?php if($userdata['boxcolor'] == "Purple") {?>selected<?php }?>>Purple</option>
	            <option id = "brown" <?php if($userdata['boxcolor'] == "Brown") {?>selected<?php }?>>Brown</option>
	            <option id = "gray" <?php if($userdata['boxcolor'] == "Gray") {?>selected<?php }?>>Gray</option>
	            <option id = "papayawhip" <?php if($userdata['boxcolor'] == "Papayawhip") {?>selected<?php }?>>Papayawhip</option>
	            <option id = "salmon" <?php if($userdata['boxcolor'] == "Salmon") {?>selected<?php }?>>Salmon</option>
	            <option id = "burlywood" <?php if($userdata['boxcolor'] == "Burlywood") {?>selected<?php }?>>Burlywood</option>
	            <option id = "skyblue" <?php if($userdata['boxcolor'] == "Skyblue") {?>selected<?php }?>>Skyblue</option>
	            <option id = "chartreuse" <?php if($userdata['boxcolor'] == "Chartreuse") {?>selected<?php }?>>Chartreuse</option>
	            <option id = "darkmagenta" <?php if($userdata['boxcolor'] == "Darkmagenta") {?>selected<?php }?>>Darkmagenta</option>
	            <option id = "tomato" <?php if($userdata['boxcolor'] == "Tomato") {?>selected<?php }?>>Tomato</option>
	            <option id = "turquoise" <?php if($userdata['boxcolor'] == "Turquoise") {?>selected<?php }?>>Turquoise</option>
	            <option id = "yellowgreen" <?php if($userdata['boxcolor'] == "Yellowgreen") {?>selected<?php }?>>Yellowgreen</option>
	            <option id = "teal" <?php if($userdata['boxcolor'] == "Teal") {?>selected<?php }?>>Teal</option>
	            <option id = "goldenrod" <?php if($userdata['boxcolor'] == "Goldenrod") {?>selected<?php }?>>Goldenrod</option>
	            <option id = "gold" <?php if($userdata['boxcolor'] == "Gold") {?>selected<?php }?>>Gold</option>
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
	<p>
		<button class = "btn btn-primary" type = "submit" value = "submit"><i class = "fa fa-check"></i>Update</button>
	</p>
</form>


</body>
<?php require_once '../views/footer.php'; ?>
</html>