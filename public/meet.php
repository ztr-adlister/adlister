<?php
session_start();
if(!isset($_SESSION['Loggedinuser'])) {
	$loginstatus = "Members, Log In!";
} else {
	$loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ZTR Industries Ad Lister 3000</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/reagan.css">
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>
        <br><br><br><br>
       	<h3>Meet the ZTR team!</h3>
       	<div id = "meetzee"><span class = "letter">Z</span>ee<br><br><br></div><br><br><br>
       	<div id = "meettony"><span class = "letter">T</span>ony</div>
       	<br><br><br><div id = "meetreagan"><span class = "letter">R</span>eagan<br><br><br></div><br><br><br>