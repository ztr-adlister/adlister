<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';

    function pageController()
    {
        // Gets the current session.
        session_start();
        
        if(!isset($_SESSION['Loggedinuser'])) {
            $loginstatus = "Members, Log In!";
        } else {
            $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        }

        return array(
            'loginstatus' => $loginstatus
        );    
    }

    extract(pageController());

?>

<!DOCTYPE html>
<html lang="en">
    
    <?php require_once '../views/header.php'; ?>    
    
    <body class="dealspagebody">
        <?php require_once '../views/navbar.php'; ?>
        
        <div class="container pushdancingspatsdown">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- This h1 has each letter in a span so that the CSS animation can run at different times for each letter to create the blinking effect. -->
                    <h1 class="dealstitle"><span class="letter1">S</span><span class="letter2">p</span><span class="letter3">a</span><span class="letter4">t</span><span class="letter5">u</span><span class="letter6">l</span><span class="letter7">a</span> <span class="letter8">C</span><span class="letter1">i</span><span class="letter2">t</span><span class="letter3">y</span> <span class="letter4">D</span><span class="letter5">e</span><span class="letter6">a</span><span class="letter7">l</span><span class="letter8">s!</span></h1>
                </div> <!-- end col-md-12 -->
                <div class="col-md-10 col-md-offset-1 text-center">
                    <!-- These are the images for the dancing spatulas. They all use the same CSS animation. -->
                    <img src="img/spatula_icon_blue.png" class="img-responsive dancingspatula" id="lblue" alt="Responsive image">
                    <img src="img/spatula_icon_red.png" class="img-responsive dancingspatula" id="lred"alt="Responsive image">
                    <img src="img/spatula_icon_green.png" class="img-responsive dancingspatula" id="lgreen" alt="Responsive image">
                    <img src="img/spatula_icon_purple.png" class="img-responsive dancingspatula" id="lpurple" alt="Responsive image">
                    <img src="img/spatula_icon_orange.png" class="img-responsive dancingspatula" id="lorange" alt="Responsive image">
                    <img src="img/spatula_icon_pink.png" class="img-responsive dancingspatula" id="lpink" alt="Responsive image">
                    <img src="img/spatula_icon_yellow.png" class="img-responsive dancingspatula" id="lyellow" alt="Responsive image">
                    <img src="img/spatula_icon_ourblue.png" class="img-responsive dancingspatula" id="lourblue" alt="Responsive image">
                </div> <!-- end col-md-10 -->
            </div> <!-- End row. -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="dealscode">All Spatulas are ON SALE everyday! Mention this at checkout.</p>
                </div> <!-- End col-md-12. -->
            </div> <!-- End row. -->
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>

    </body>
</html>