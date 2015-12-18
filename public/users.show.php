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
require_once 'css/userbox.php';
$loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}

User::dbConnect();
$stmt = $dbc->prepare('SELECT username, id, icon FROM users WHERE username = :username');
$stmt->bindValue(':username', $_SESSION['Loggedinuser'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt1 = $dbc->prepare('SELECT * FROM ads WHERE user_id = :id');
$stmt1->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt1->execute();
$userads = $stmt1;

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
        <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">
        <style type="text/css">

        </style>
    </head>
    <?php require_once '../views/navbar.php'; ?>
    <body>
    	<h2 class = "show">Hello, <?=$user['username'] ?>!</h2>
        <div id = "box"><br><br><i class = "fa fa-<?=$user['icon']?> fa-5x"></i></div>

<!-- Ads the user has posted -->
    	<h3 class = "show">Your Ads:</h3>
    	<ul class = "show">
    		<?php foreach($userads as $advalue) {?>
            <li><strong>Title:</strong> <?=$advalue['title']?></li>
            <li><strong>Description:</strong> <?=$advalue['description']?></li>
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>
            <br>
            <?php } ?>
        <a href="ads.create.php" id = "createads"><i class = "fa fa-commenting-o"></i>Post a new Ad</a>
        <br><br><br><br>
        <a href="ads.edit.php" id = "editads"><i class = "fa fa-pencil"></i>Edit an existing Ad</a>
        <br><br><br>
        </ul>
    	<br>
<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php"><i class = "fa fa-pencil"></i>Edit your profile</a>
        <br><br>
<!-- Logs you out -->
        <a class="show" id = "logout" href = "auth.logout.php"><i class = "fa fa-sign-out"></i>Log Out</a>
        <br><br>
    </body>
    <?php require_once '../views/footer.php'; ?>