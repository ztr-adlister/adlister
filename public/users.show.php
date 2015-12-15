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
        <style>
        body {
            background-color: #E0E0E0;
        }
        /*Centers all text except for the footer*/
        .show {
        	text-align: center;
        	margin-top: 50px;
        }
        /*Takes all dots off of the lists*/
        ul {
        	list-style-type: none;
        }
        /*Styling for the link to the edit profile page*/
        #editprofile {
        	background-color: skyblue;
        	color: white;
        	padding: 10px;
        	margin-left: 40%;
            margin-right: 40%;
            margin-top: -10px;
        	text-decoration: none;
        	box-shadow: 5px 5px 5px black;
        }
        #editprofile:hover {
        	background-color: blue;
        }
        /*The User's box. When we add PHP, the color will be whatever the user specifies*/
        #box {
            background-color: gray;
            width: 200px;
            height: 200px;
            margin-left: 42%;
            border: 5px solid black;
        }
        /*Styling for unordered lists in the body (because the navbar is technically an unordered list, and we don't want this styling applied to it*/
        body > ul {
            border: 1px solid black;
            background-color: #C0C0C0;

        }
        </style>
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