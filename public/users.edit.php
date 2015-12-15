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
    <body>
    	<?php require_once '../views/navbar.php'; ?>
    	<br><br><br>
    	<form>
    		<p>What do you want to update?</p>
    		<p>
    		<label><input type = "checkbox" id = "update1" name="update[]" value = "email">Email</label>
    		</p>
    		<p>
    		<label><input type = "checkbox" id = "update2" name = "update[]" value = "username">Username</label>
    		</p>
    		<p>
    		<label><input type = "checkbox" id = "update3" name = "update[]" value = "password">Password</label>
    		</p>
    	</form>
    	<br>
    	<form>
    		<p>
    			<label for "updatemail">Email</label>
    			<input type = "text" name = "updatemail" id = "updatemail">
    		</p>
    		<p>
    			<label for "updatename">Username</label>
    			<input type = "text" name = "updatename" id = "updatename">
    		</p>
    		<p>
    			<label for "updatepassword">Password</label>
    			<input type ="text" name = "updatepassword" id = "updatepassword">
    		</p>
    		<p>
    			<label for "updateconfirm">Confirm New Password</label>
    			<input type = "text" name = "updateconfirm" id = "updateconfirm">
    		</p>
    		<button type = "submit" value = "submit">Update</button>
    	</form>
    </body>