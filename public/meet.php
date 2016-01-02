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
        <link rel="icon" type="image/png" href="img/icon.png">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spatula City: Meet</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Fugaz+One|Shadows Into Light' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/z.css">
    </head>
    <body class= "meetColor">
        <?php require_once '../views/navbar.php'; ?>

        <div class="container meetPage">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="h1Sy">Meet Our President: Sy Greenblum</h1>
                </div> <!-- End col-md-12 -->  
            </div> <!-- End of Row -->

            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center" id= "aboutSy">
                    <img src="img/sy_pres.png" class="img-responsive sy" alt="Responsive image">
                    <div class="pPadding">    
                        <p>Hello,</p>
                        <p>I'm Sy Greenblum, president of Spatula City.</p> 
                        <p>I liked their spatulas so much, I bought the company. Because we eliminate the middleman, we can sell all our spatulas factory direct to you.</p>
                        <p>I use a spatula everyday. If it weren't for the spatula, I wouldn't be the man you see before you today.</p> 
                        <p>There are thousands of spatulas that need your love. Please help them find a forever home.</p>
                        <p>Thank you for supporting spatulas. If you don't get your spatula here, please get one somewhere.</p><br>
                        <p>Sincerely,</p>
                        <p>Sy Greenblum</p>
                    </div><!--Close ppadding -->  
                </div><!-- End col-md-6 -->
            </div><!-- End of Row -->  
        </div> <!-- End Container -->
        <?php require_once '../views/footer.php'; ?>
    </body>
</html>      