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
        <style>
        body {
        	text-align: center;
        	margin-top: 60px;
        }
        ul {
        	list-style-type: none;
        }
        #editprofile {
        	background-color: skyblue;
        	color: white;
        	padding: 10px;
        	margin-left: 45px;
        	text-decoration: none;
        	box-shadow: 5px 5px 5px black;
        }
        #editprofile:hover {
        	background-color: blue;
        }
        </style>
    </head>
    <?php require_once '../views/navbar.php'; ?>
    <body>
    	<h2>Hello, {User}!</h2>

    	<h3>Your Ads:</h3>
    	<ul>
    		<li>Ad1</li>
    		<li>Ad2</li>
    		<li>Ad3</li>
    		<li>Ad4</li>
    		<li>Ad5</li>
    	</ul>

    	<h3>Ads you have responded to:</h3>
    	<ul>
    		<li>Ad1</li>
    		<li>Ad2</li>
    		<li>Ad3</li>
    		<li>Ad4</li>
    		<li>Ad5</li>
    	</ul>
    	<br>
    	<a id = "editprofile" href="users.edit.php">Edit your profile</a>
    </body>
    <?php require_once '../views/footer.php'; ?>