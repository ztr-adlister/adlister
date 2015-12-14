<?php
require_once '';
require_once '';

session_start();
// get the current session id
$sessionId = session_id();

$userName = Input::get('userName');
$password = Input::get('password');
$login = '';


// why is this an if statement and the line below it, as well? 
if(Auth::check())
{
    header("Location: authorized.php"); 
    die();
}

if(Auth::attempt($userName, $password))
{
    header("Location: authorized.php");
    die();
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
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container">
            <form method="POST">
                <label>UserName:</label>
                <input value="<?= Input::escape($userName)?>" type="text" name="userName" autofocus><br>
                <label>Password:</label>
                <input type="password" name="password"><br>
                <input type="submit">
            </form>

            <h2><?= $login ?><h2>
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>