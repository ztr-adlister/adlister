<?php
require_once '../utils/Auth.php';
require_once '../utils/Input.php';
require_once '../models/User.php';
require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';
session_start();
$stmt = $dbc->query('SELECT * FROM users');
$stmt->execute();
$database = $stmt->fetchAll(PDO::FETCH_ASSOC);
$message = '';
$username = Input::get('username');
$email = Input::get('email');
if($username != '' && $email != '') {
	$retrieveduser = User::finduserbyusername($username);
	$message = $retrieveduser->reminder;
}
if(Auth::check()) {
	header('location: users.show.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once '../views/header.php'; ?>
    <body class = "meetColor">
        <?php require_once '../views/navbar.php'; ?>

        <div class="container login_container">
        	<h2 class = "textinfrontofbackground">Please enter all information below to retrieve your reminder</h2>
        <div class = "message"><?=$message;?></div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <form class= "form-horizontal" method="POST" action = "auth.forgot.php">
                        <div class="form-group">
                            <label class="control-label col-sm-5 textinfrontofbackground">Username:</label>
                            <div class="col-sm-6">
                                <input type="text" name="username" autofocus><br>
                            </div>
                        </div>
                            
                        <div class="form-group">   
                                <label class="control-label col-sm-5 textinfrontofbackground">Email:</label>
                            <div class="col-sm-6">
                                <input type="text" name="email"><br>
                            </div>    
                        </div>
                        
                        <button class="btn btn-default" type="submit"><i class="fa fa-check"></i></span>Submit</button>
                    </form>
                    <a id = "forgot" href="auth.login.php">Back to login</a>
                </div>
            </div>        
            <!-- <h2><?= $login ?><h2> -->
        </div> <!-- End container. -->
     <?php require_once '../views/footer.php'; ?>