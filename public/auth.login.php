<?php
// require_once '../utils/Auth.php';
// require_once '../utils/Input.php';

// session_start();
// // get the current session id
// $sessionId = session_id();

// $userName = Input::get('userName');
// $password = Input::get('password');
// $login = '';


// why is this an if statement and the line below it, as well? 
// if(Auth::check())
// {
//     header("Location: authorized.php"); 
//     die();
// }

// if(Auth::attempt($userName, $password))
// {
//     header("Location: authorized.php");
//     die();
// } 

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
        
        <style type="text/css">
            .login_container{
                margin-top: 70px;
            }

        </style>

    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container login_container">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <form class= "form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm-5">Username:</label>
                            <div class="col-sm-6">
                                <input type="text" name="userName" autofocus><br>
                            </div>
                        </div>
                            
                        <div class="form-group">   
                                <label class="control-label col-sm-5">Password:</label>
                            <div class="col-sm-6">
                                <input type="password" name="password"><br>
                            </div>    
                        </div>
                        
                        <button class="btn btn-default" type="submit">Submit</button>
                    </form>
                </div>
            </div>        
            <!-- <h2><?= $login ?><h2> -->
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>