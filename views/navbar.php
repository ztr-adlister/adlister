<?php

$arrayPhrases = [
    "There's just one place to go for all your spatula needs - Spatula City!", 
    "A giant warehouse of spatulas for every occasion.", 
    "Thousands to choose from in every shape, size, and color.",
    "Don't forget, they make great Christmas presents.",
    "And what better way to say 'I love you.' than with the gift of a spatula?",
    "Spatula City - Seven locations!",
    "We're in the yellow pages under 'spatulas'.",
    "We sell spatulas, and that's all!",
    "And this weekend only, take advantage of our special liquidation sale.",
    "Buy nine spatulas, get the tenth one for just one penny.", 
    "And because we eliminate the middle man, we can sell all our spatulas factory direct to you."
    ];

    $arrayPhrasesKey = array_rand($arrayPhrases, 1);
    $phrase = $arrayPhrases[$arrayPhrasesKey];

?>
<link href='https://fonts.googleapis.com/css?family=Fugaz+One|Playball' rel='stylesheet' type='text/css'>
<style type="text/css">
    .tippytop {
        background-color: #ffffff;
        height: 65px;
        width: 100%;
        position: absolute;
        top: 0px;
        left: 0px;
    }
    .phrases {
        position: relative;
        display: inline-block;
        left: 170px;
    }
    .customnav {
        background-color: #0062cc;
        margin-top: 65px;
        height: 90px;
        color: #ffffff;
    }
    .customnav a {
        color: #ffffff;
        line-height: 90px;
        margin: 0 15px 0 15px;
    }
    .customnav i {
        font-size: 40px;
        line-height: 90px;
    }
    .spatulaholder {
        width: 62px;
        height: 200px;
        background-color: transparent;
        position: absolute;
        top: -7px;
        left: 25px;
    }
    .handle {
        width: 16px;
        height: 60px;
        border-radius: 5px;
        background-color: #000000;
        position: absolute;
        bottom: 10px;
        left: 23px;
        z-index: 2;
    }
    .stem {
        width: 10px;
        height: 72px;
        background-color: #d9d9d9;
        position: absolute;
        bottom: 50px;
        left: 26px;
    }
    .flatend {
        width: 42px;
        height: 60px;
        border-radius: 5px;
        background-color: #d9d9d9;
        position: absolute;
        bottom: 120px;
        left: 10px;
    }
    .rectangle {
        width: 6px;
        height: 40px;
        border-radius: 2px;
        background-color: #ffffff;
    }
    #rect1 {
        position: absolute;
        top: 10px;
        left: 6px;   
    }
    #rect2 {
        position: absolute;
        top: 10px;
        left: 18px;   
    }
    #rect3 {
        position: absolute;
        top: 10px;
        left: 30px;   
    }
    .logo {
        font-size: 35px;
        font-family: 'Fugaz One', cursive;
        color: #ffffff;
        text-shadow: 4px -3px 0px #003d80;
    }
    .logo:hover {
        text-shadow: 4px 3px 0px #000, 9px 8px 0px rgba(0,0,0,0.30);
        text-decoration: none;
    }
</style>

<div class="tippytop hidden-xs hidden-sm">
    <h3 class="phrases"><?= $phrase; ?></h3>
</div> <!-- end tippytop -->

<div class="spatulaholder hidden-xs hidden-sm">
    <div class="handle"></div>
    <div class="stem"></div>
    <div class="flatend">
        <div class="rectangle" id="rect1"></div>
        <div class="rectangle" id="rect2"></div>
        <div class="rectangle" id="rect3"></div>
    </div>
</div> <!-- end spatulaholder -->
    
<nav class="customnav">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4 text-center col-sm-7 col-xs-9">
                <a class="logo" href="index.php">Spatula City</a>
            </div> <!-- end col-md-4 -->             

            <div class="col-md-8 text-center hidden-xs hidden-sm">        
                <a href="ads.index.php">My Store</a>
                <a href="ads.index.php">Products</a>
                <a href="ads.index.php">Deals</a>
                <a href="ads.index.php">Sell Your Spatula</a>
                <a <?php if(!isset($_SESSION['Loggedinuser'])) {?>style="display:none"<?php }?> href="users.show.php">Your Profile</a>
                <a <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?> href="auth.login.php">Members, Log In!</a>
                <a <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?> href="users.create.php">Sign Up</a>
                <a href="meet.php">About Spatula City</a>
            </div> <!-- end col-md-8 -->

            <div class="col-sm-5 col-xs-3 hidden-md hidden-lg text-center">
                <i class="fa fa-bars"></i>
            </div> <!-- end col-sm-5 col-xs-3 -->

        </div> <!-- end row -->
    </div> <!-- end container fluid -->
</nav>


