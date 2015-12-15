<?php
/* TODO:
1) Redirect to login if user isn't logged in.
2) Feed in user info from database.
3) Make sure that the session that started on the login page is still running
*/
?>
<!DOCTYPE html>
<!-- Carried over from the index -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Profile</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/reagan.css">
    </head>
    <?php require_once '../views/navbar.php'; ?>
    <body>
    	<h2 class = "show">Hello, {User}!</h2>
        <div id = "box"></div>

<!-- Ads the user has posted -->
    	<h3 class = "show">Your Ads:</h3>
    	<ul class = "show">
    		<li>Ad1</li>
    		<li>Ad2</li>
    		<li>Ad3</li>
    		<li>Ad4</li>
    		<li>Ad5</li>
    	</ul>

<!-- Ads the user has responded to -->
    	<h3 class = "show">Ads you have responded to:</h3>
    	<ul class = "show">
    		<li>Ad1</li>
    		<li>Ad2</li>
    		<li>Ad3</li>
    		<li>Ad4</li>
    		<li>Ad5</li>
    	</ul>
    	<br>
<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php">Edit your profile</a>
        <br><br>
    </body>
    <?php require_once '../views/footer.php'; ?>