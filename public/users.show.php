<?php
/* TODO:
1) Redirect to login if user isn't logged in.
2) Feed in user info from database.
3) Make sure that the session that started on the login page is still running
*/
session_start();
require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';
require_once '../models/Basemodel.php';
require_once '../models/User.php';
require_once '../utils/Auth.php';
require_once '../models/Ad.php';
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}

$stmt = $dbc->prepare('SELECT username FROM users WHERE username = :username');
$stmt->bindValue(':username', $_SESSION['Loggedinuser'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt;

$stmt1 = $dbc->prepare('SELECT * FROM ads WHERE id <= :id');
$stmt1->bindValue(':id', 4, PDO::PARAM_INT);
$stmt1->execute();
$userads = $stmt1;

$stmt2 = $dbc->prepare('SELECT * FROM ads WHERE id > :id');
$stmt2->bindValue(':id', 4, PDO::PARAM_INT);
$stmt2->execute();
$chosenads = $stmt2;

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
        <?php foreach($user as $userdata) {?>
    	<h2 class = "show">Hello, <?=$userdata['username']?>!</h2>
        <?php } ?>
        <div id = "box"></div>

<!-- Ads the user has posted -->
    	<h3 class = "show">Your Ads:</h3>
    	<ul class = "show">
    		<?php foreach($userads as $advalue) {?>
            <li><strong>Title:</strong> <?=$advalue['title']?></li>
            <li><strong>Description:</strong> <?=$advalue['description']?></li>
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>
            <br>
            <?php } ?>
    	</ul>

<!-- Ads the user has responded to -->
    	<h3 class = "show">Ads you have responded to:</h3>
    	<ul class = "show">
    		<?php foreach($chosenads as $chosenthings) {?>
            <li><strong>Title:</strong> <?=$chosenthings['title']?></li>
            <li><strong>Description:</strong> <?=$chosenthings['description']?></li>
            <li><strong>Price:</strong> $<?=$chosenthings['price']?></li>
            <br>
            <?php } ?>
    	</ul>
    	<br>
<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php">Edit your profile</a>
        <br><br>
<!-- Logs you out -->
        <a class="show" id = "logout" href = "auth.logout.php">Log Out</a>
    </body>
    <?php require_once '../views/footer.php'; ?>