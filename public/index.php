<?php

    // function pageController()
    // {
        // PHP code goes here.    
    // }

    // extract(pageController());
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
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2>The ZTR Industries Ad Lister 3000</h2>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

            <div class="row">
                <div class="col-md-2">
                    <h4>Other Stuff of Some Import</h4>
                    <form method="POST" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Search</label>
                            <div class="col-sm-6">
                                <input type="text" name="description" value="..." class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </form>
                </div> <!-- End col-md-12 -->
                <div class="col-md-8">
                    <h3>Newest Ads</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><img src="..." class="img-responsive" alt="Responsive image"><p>stuff and things.</p></li>
                        <li class="list-group-item"><img src="..." class="img-responsive" alt="Responsive image"><p>stuff and things.</p></li>
                        <li class="list-group-item"><img src="..." class="img-responsive" alt="Responsive image"><p>stuff and things.</p></li>
                    </ul>    

                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

            <div class="row">
                <div class="col-md-12">
                    <h4>Other Stuff of Some Import</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>