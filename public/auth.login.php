<?php
require_once '../utils/Auth.php';
require_once '../utils/Input.php';
require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';
$loginstatus = "Members, Log In!";
$stmt = $dbc->query('SELECT * FROM users');
$stmt->execute();
$database = $stmt->fetchAll(PDO::FETCH_ASSOC);
session_start();
// get the current session id
$sessionId = session_id();

// $login = '';
 

// if(Auth::check())
// {
//     header("Location: authorized.php"); 
//     die();
// }
// $username = Input::get('username') ? Input::get('username') : null;
// $password = Input::get('password') ? Input::get('password') : null;
$message = '';
$username = Input::get('username');
$password = Input::get('password');

if ($username != NULL && $password != NULL) {
    Auth::attempt($username, $password);
    if (!Auth::attempt($username, $password)) {
        $message = "Your information is incorrect";
    }
} 

if(Auth::check()) {
    header('Location: users.show.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
   <?php require_once '../views/header.php'; ?>
    <body class = "meetColor">
        <?php require_once '../views/navbar.php'; ?>
<br>
        <div class = "failure"><?=$message;?></div>
        <div class="container login_container">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <form class= "form-horizontal" method="POST" action = "auth.login.php">
                        <div class="form-group">
                            <label class="control-label col-sm-5 textinfrontofbackground">Username:</label>
                            <div class="col-sm-6">
                                <input type="text" name="username" autofocus><br>
                            </div>
                        </div>
                            
                        <div class="form-group">   
                                <label class="control-label col-sm-5 textinfrontofbackground">Password:</label>
                            <div class="col-sm-6">
                                <input type="password" name="password"><br>
                            </div>    
                        </div>
                        
                        <button class="btn btn-default" type="submit"><i class="fa fa-check"></i></span>Submit</button>
                    </form>
                    <a href = "auth.forgot.php" id = "forgot">Forgot Password?</div>
            </div>        
            <!-- <h2><?= $login ?><h2> -->
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>