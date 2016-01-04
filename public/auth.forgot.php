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
$error = '';
$username = Input::get('username');
$email = Input::get('email');
$boxcolor = strtolower(Input::get('boxcolor'));
$icon = strtolower(Input::get('icon'));
if($username != '' && $email != '' && $icon != '' && $boxcolor != '') {
	$retrieveduser = User::finduserbyusername($username);
    // $stmt1 = $dbc->prepare('SELECT * FROM users WHERE username = :username');
    // $stmt1->bindValue(':username', $retrieveduser->username, PDO::PARAM_STR);
    // $stmt1->execute();
    // $founduser = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    if($username == $retrieveduser->username) {
        if($email == $retrieveduser->email) {
            if($boxcolor == strtolower($retrieveduser->boxcolor)) {
                if($icon == strtolower($retrieveduser->icon)) {
                	$message = $retrieveduser->reminder;
                } else {
                    $error = "Your icon is incorrect";
                }
            } else {
                $error = "You box color is incorrect";
            }
        } else {
            $error = "Your email is incorrect";
        }
    } else {
        $error = "Your username is incorrect";
    }
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
        <div class = "success"><?=$message;?></div><div class = "error"><?=$error?></div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <form class= "form-horizontal" method="POST" action = "auth.forgot.php">
                        <div class="form-group">
                            <label class="control-label col-sm-5 textinfrontofbackground" for="username">Username:</label>
                            <div class="col-sm-6">
                                <input type="text" name="username" id = "username" autofocus><br>
                            </div>
                        </div>
                            
                        <div class="form-group">   
                                <label class="control-label col-sm-5 textinfrontofbackground" for="email">Email:</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" id = "text"><br>
                            </div>    
                        </div>

                        <div class="form-group">   
                                <label class="control-label col-sm-5 textinfrontofbackground" for="boxcolor">Boxcolor:</label>
                            <div class="col-sm-6">
                                <input type="text" name="boxcolor" id = "boxcolor"><br>
                            </div>    
                        </div>

                        <div class="form-group">   
                                <label class="control-label col-sm-5 textinfrontofbackground" for="icon">Icon:</label>
                            <div class="col-sm-6">
                                <input type="text" name="icon" id = "icon"><br>
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