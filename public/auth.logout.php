<?php
require_once '../utils/Auth.php';

session_start();

if (Auth::check() || Auth::user()) {
    $user = Auth::user();
    Auth::logout();
    header("Location: auth.login.php", true, 307);
    die();
}


?>

<!-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ZTR Industries Ad Lister 3000</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php ; ?>

        <div class="container">
         