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
	if ($updateuser->email == $userdata['email'] || empty($emailcheck)) {
		if($updateuser->email != "") {
			$updateuser->save();
			$success = "Email successfully updated";
		} else {
			$error = "Please enter a valid email address";
		}
	} else {
		$error = "This email is already taken";
	}
} else if ($choice == "phone") {
	$updateuser->phone = $newdata;
	$updateuser->save();
	$success = "Phone Number Successfully Updated";
} else if ($choice == "username") {
	$updateuser->username = $newdata;
	$usercheck = User::finduserbyusername($updateuser->username);
	if($updateuser->username == $userdata['username'] || empty($usercheck)) {
		if($updateuser->username != "") {
			$updateuser->save();
			$_SESSION['Loggedinuser'] = $updateuser->username;
			$success = "Username successfully updated";
		} else {
			$error = "Please enter a valid username";
		}
	} else {
		$error = "This username is already taken";
	}
} else if ($choice == "password") {
	if($newdata!= "") {
		if($newdata == Input::get('confirmpass')) {
			if(!empty(Input::get('newreminder'))) {
				$updateuser->password = password_hash($newdata, PASSWORD_DEFAULT);
				$updateuser->reminder = Input::get('newreminder');
				$updateuser->save();
				$success = "Password successfully updated";
			} else {
				$error = "Please enter a reminder for your password!";
			}
		} else {
			$error = "Your passwords do not match";
		}
	} else {
		$error = "Please enter a valid password";
	}
} else if ($choice == "box color") {
	if ($updateuser->boxcolor != $userdata['boxcolor']) {
		$updateuser->save();
		header('location: users.show.php');
		die();
	} else {
		$error = "Enter your new box color";
	}
} else if ($choice == "icon") {
	if ($updateuser->icon != $userdata['icon']) {
		$updateuser->save();
		header('location: users.show.php');
		die();
	} else {
		$error = "Enter your new icon";
	}
}
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}
?>
<!DOCTYPE html>
<html>
<?php require_once '../views/header.php'; ?>
<body>
	<?php require_once '../views/navbar.php'; ?>
	<br><br><br><br>
<!-- Displays the message -->
	<div class = "error"><?=$error?></div>
	<div class = "success"><?=$success?></div>
<!-- The form itself -->
<form class = "edit" method="POST" action = "users.edit.php">
<!-- Select your edit field -->
	<p id="updrop">
		<label for "updatechoice">What information do you want to edit?</label>
		<select id ="updatechoice" name="updatechoice" required>
			<option selected disabled>Select a Field</option>
			<option <?php if($choice == "box color") {?>selected<?php }?>>box color</option>
			<option <?php if($choice == "icon") {?>selected<?php }?>>icon</option>
			<option <?php if($choice == "email") {?>selected<?php }?>>email</option>
			<option <?php if($choice == "phone") {?>selected<?php }?>>phone</option>
			<option <?php if($choice == "username") {?>selected<?php }?>>username</option>
			<option <?php if($choice == "password") {?>selected<?php }?>>password</option>
		</select>
<!-- Text input field -->
	<p <?php if ($choice == "box color" || $choice == "icon" || $choice == "") {?>style = "display:none"<?php }?>>
		<label for "updatefield">New <?php if ($choice == "email") {?>Email<?php } else if ($choice == "phone") {?>Phone<?php } else if ($choice == "username") {?>Username<?php } else if ($choice == "password") {?>Password<?php }?>: </label>
		<input type = <?php if ($choice == "password") {?> password <?php } else {?> text <?php }?> name = "updatefield" id = "updatefield">
	</p>
<!-- Confirm password field -->
	<p id = "conf" <?php if ($choice != "password") {?>style = "display:none"<?php }?>>
		<label for "confirmpass">Confirm Password:</label>
		<input type = "password" name = "confirmpass" id = "confirmpass">
	</p>
	<p id = "newrem" <?php if ($choice != "password") {?>style = "display:none"<?php }?>>
		<label for "newreminder">Set a new reminder: </label>
		<input type = "text" name = "newreminder" id = "newreminder">
	</p>
	</p>
	 <p id = "updatecolor" <?php if($choice != "box color") {?>style = "display:none"<?php } else {?>style = "display:initial"<?php }?>>
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
            <p id = "updateicon" <?php if($choice != "icon") {?>style = "display:none"<?php }?>>
                <label for "icontype">Icon</label>
               <select id = "icontype" name = "icontype" required>
                <option <?php if($userdata['icon'] == "university") {?>selected<?php }?>>university</option>
                <option<?php if($userdata['icon'] == "beer") {?>selected<?php }?>>beer</option>
                <option <?php if($userdata['icon'] == "bug") {?>selected<?php }?>>bug</option>
                <option <?php if($userdata['icon'] == "bullseye") {?>selected<?php }?>>bullseye</option>
                <option <?php if($userdata['icon'] == "car") {?>selected<?php }?>>car</option>
                <option <?php if($userdata['icon'] == "anchor") {?>selected<?php }?>>anchor</option>
                <option <?php if($userdata['icon'] == "bomb") {?>selected<?php }?>>bomb</option>
                <option <?php if($userdata['icon'] == "birthday-cake") {?>selected<?php }?>>birthday-cake</option>
                <option <?php if($userdata['icon'] == "bed") {?>selected<?php }?>>bed</option>
                <option <?php if($userdata['icon'] == "diamond") {?>selected<?php }?>>diamond</option>
                <option <?php if($userdata['icon'] == "female") {?>selected<?php }?>>female</option>
                <option <?php if($userdata['icon'] == "male") {?>selected<?php }?>>male</option>
                <option <?php if($userdata['icon'] == "plane") {?>selected<?php }?>>plane</option>
                <option <?php if($userdata['icon'] == "paper-plane") {?>selected<?php }?>>paper-plane</option>
                <option <?php if($userdata['icon'] == "eye") {?>selected<?php }?>>eye</option>
                <option <?php if($userdata['icon'] == "paw") {?>selected<?php }?>>paw</option>
                <option <?php if($userdata['icon'] == "spoon") {?>selected<?php }?>>spoon</option>
                <option <?php if($userdata['icon'] == "cloud") {?>selected<?php }?>>cloud</option>
                <option <?php if($userdata['icon'] == "home") {?>selected<?php }?>>home</option>
                <option <?php if($userdata['icon'] == "rocket") {?>selected<?php }?>>rocket</option>
                <option <?php if($userdata['icon'] == "ship") {?>selected<?php }?>>ship</option>
                <option <?php if($userdata['icon'] == "road") {?>selected<?php }?>>road</option>
                <option <?php if($userdata['icon'] == "shield") {?>selected<?php }?>>shield</option>
                <option <?php if($userdata['icon'] == "star") {?>selected<?php }?>>star</option>
                <option <?php if($userdata['icon'] == "plug") {?>selected<?php }?>>plug</option>
                <option <?php if($userdata['icon'] == "money") {?>selected<?php }?>>money</option>
                <option <?php if($userdata['icon'] == "money") {?>selected<?php }?>>music</option>
                <option <?php if($userdata['icon'] == "magnet") {?>selected<?php }?>>magnet</option>
                <option <?php if($userdata['icon'] == "magic") {?>selected<?php }?>>magic</option>
                <option <?php if($userdata['icon'] == "graduation-cap") {?>selected<?php }?>>graduation-cap</option>
                <option <?php if($userdata['icon'] == "bell") {?>selected<?php }?>>bell</option>
                <option <?php if($userdata['icon'] == "bicycle") {?>selected<?php }?>>bicycle</option>
                <option <?php if($userdata['icon'] == "code") {?>selected<?php }?>>code</option>
                <option <?php if($userdata['icon'] == "building") {?>selected<?php }?>>building</option>
                <option <?php if($userdata['icon'] == "barcode") {?>selected<?php }?>>barcode</option>
                <option <?php if($userdata['icon'] == "database") {?>selected<?php }?>>database</option>
                <option <?php if($userdata['icon'] == "flag") {?>selected<?php }?>>flag</option>
                <option <?php if($userdata['icon'] == "flask") {?>selected<?php }?>>flask</option>
                <option <?php if($userdata['icon'] == "gavel") {?>selected<?php }?>>gavel</option>
                <option <?php if($userdata['icon'] == "glass") {?>selected<?php }?>>glass</option>
                <option <?php if($userdata['icon'] == "heart") {?>selected<?php }?>>heart</option>
                <option <?php if($userdata['icon'] == "key") {?>selected<?php }?>>key</option>
                <option <?php if($userdata['icon'] == "leaf") {?>selected<?php }?>>leaf</option>
                <option <?php if($userdata['icon'] == "gift") {?>selected<?php }?>>gift</option>
                <option <?php if($userdata['icon'] == "gamepad") {?>selected<?php }?>>gamepad</option>
                <option <?php if($userdata['icon'] == "ticket") {?>selected<?php }?>>ticket</option>
                <option <?php if($userdata['icon'] == "truck") {?>selected<?php }?>>truck</option>
                <option <?php if($userdata['icon'] == "thumbs-up") {?>selected<?php }?>>thumbs-up</option>
                <option <?php if($userdata['icon'] == "tree") {?>selected<?php }?>>tree</option>
                <option <?php if($userdata['icon'] == "trophy") {?>selected<?php }?>>trophy</option>
                <option <?php if($userdata['icon'] == "umbrella") {?>selected<?php }?>>umbrella</option>
                <option <?php if($userdata['icon'] == "coffee") {?>selected<?php }?>>coffee</option>
            </select>
            </p>
	<p>
		<button class = "btn btn-primary" type = "submit" value = "submit"><i class = "fa fa-check"></i>Update</button>
	</p>
</form>


</body>
<?php require_once '../views/footer.php'; ?>
</html>