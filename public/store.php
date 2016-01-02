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

    <?php require_once '../views/header.php'; ?>

<body class= "meetColor">
    <?php require_once '../views/navbar.php'; ?>

    <div class="container storePage">
                  
        <div class="row spatVid">
            <div class="col-md-12">
                <p class="vidText">Watch Our UHF Channel 62 Commercial</p>      
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/2XbCWmY0eqY" frameborder="0" allowfullscreen></iframe>
                </div>
            </div> <!-- end col-md-12--> 
        </div> <!-- End row -->

        <div class="row">

            <div class="col-md-4">
                <div class="storePicture">
                        <img src="img/spatulacitystore.png" class="img-responsive" alt="Responsive image">
                </div> <!-- End of storePicture  -->
            </div> <!-- end col-md-4-->  

            <div class="col-md-8 backGroundBox">  
                <div class="storeDetails">
                    <div class="tweetSy">
                        <a href="https://twitter.com/SpatulaCityPrez" target="_blank"><i class="fa fa-twitter-square fa-5x"></i> <p>Twitter Our Prez</p></a>
                    </div> <!-- end tweetSy-->
                </div> <!--end storeDetails -->  
            </div> <!-- end col-md-8--> 

        </div> <!-- End row --> 
    </div> <!-- End of Container -->

    <?php require_once '../views/footer.php'; ?>
</body>
</html>