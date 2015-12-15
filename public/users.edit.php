<?php
/* TODO:
1) Redirect to login if user is not logged in
2) Require a model class that will update user data in the database
3) Make sure that the session started in the login keeps going
4) Send user to the profile page upon successful update
*/
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
    </head>
    <body>
    	<?php require_once '../views/navbar.php'; ?>
        <!-- Puts text below the navbar -->
    	<br><br><br><br>
        <h5 class = "edit">Enter new information below (If you do not want to update a certain field, enter your old information in it)</h5>
    <!-- The edit form -->
    	<form class = "edit" method = "POST" action = "users.edit.php">
        <!-- Update Email -->
    		<p id = "em">
    			<label for "updatemail">Email</label>
    			<input type = "text"  name = "updatemail" id = "updatemail">
    		</p>
        <!-- Update Username -->
    		<p>
    			<label for "updatename">Username</label>
    			<input type = "text" name = "updatename" id = "updatename">
    		</p>
        <!-- Update Password -->
    		<p>
    			<label for "updatepassword">Password</label>
    			<input type ="password" name = "updatepassword" id = "updatepassword">
    		</p>
        <!-- Confirm Updated Password -->
    		<p id = "confirm2">
    			<label for "updateconfirm">Confirm New Password</label>
    			<input type = "password" name = "updateconfirm" id = "updateconfirm">
    		</p>
        <!-- Update Box Color -->
            <p>
                <label for "updatebox">Box Color</label>
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
    		<button class = "btn btn-primary" type = "submit" value = "submit">Update</button>
    	</form>
    </body>
     <?php require_once '../views/footer.php'; ?>