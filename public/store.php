<?php

require_once '../models/Ad.php';
require_once '../utils/Input.php';

session_start();
if(!isset($_SESSION['Loggedinuser'])) {
    $loginstatus = "Members, Log In!";
} else {
    $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
}

$locationArray= Ad::showJustLocations();
$justLocations=[];
foreach ($locationArray as $value){
    array_push($justLocations, $value['location']);
}
$locationString=implode(', ', $justLocations);
$locationExplode=explode(', ', $locationString);
$locationUnique=array_unique($locationExplode);
sort($locationUnique);

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

            <div class="col-md-4 storeHours">
                <div class="storePicture">
                        <img src="img/spatulacitystore.png" class="img-responsive" alt="Responsive image">
                </div> <!-- End of storePicture  -->
                <h1> Hours:</h1> 
                <p>Open 24/7/365!</p>
                 <h1>Locations:</h1>
                <ul>
                    <?php foreach($locationUnique as $loc): ?>
                    <li><?= $loc ?></li>
                <?php endforeach; ?>
                </ul>
            </div> <!-- end col-md-4-->  

            <div class="col-md-4 text-center">  
                <div class="storeDetails">
                    <div class="tweetSy">
                        <a href="https://twitter.com/SpatulaCityPrez" target="_blank"><i class="fa fa-twitter-square fa-5x"></i>
                        <p class="twitterSy">Twitter With Us</p>
                        </a>
                    </div> <!-- end tweetSy-->
                </div> <!--end storeDetails -->  
            </div> <!-- end col-md-4--> 

            <div class="col-md-4 backGroundBox text-center">  
                <div class="rushLimbaugh">
                    <div class="rushLimbaughArticle">
                        <img src="img/rushAndKarl.jpeg" class="img-responsive" alt="Responsive image">
                        <a href="http://www.rushlimbaugh.com/daily/2007/08/15/rush_interviews_karl_rove6" target="_blank"><p class="rushText">See what 2 of our biggest flippin' fans, Rush Limbaugh and Karl Rove, have to say about Spatula City!</p></a>
                    </div> <!-- end rushLimbaughArticle-->
                </div> <!--end rushLimbaugh -->  
            </div> <!-- end col-md-4--> 
        </div> <!-- End row --> 
    </div> <!-- End of Container -->

    <?php require_once '../views/footer.php'; ?>
</body>
</html>