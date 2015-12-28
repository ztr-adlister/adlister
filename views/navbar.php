<?php

$arrayPhrases = [
    "There's just one place to go for all your spatula needs; Spatula City!", 
    "A giant warehouse of spatulas for every occasion.", 
    "Thousands to choose from in every shape, size, and color.",
    "Don't forget, they make great Christmas presents.",
    "And what better way to say 'I love you.' than with the gift of a spatula?",
    "Spatula City - seven locations!",
    "We're in the yellow pages under 'spatulas'.",
    "We sell spatulas, and that's all!",
    "And this weekend only, take advantage of our special liquidation sale.",
    "Buy nine spatulas, get the tenth one for just one penny.", 
    "And because we eliminate the middle man, we can sell all our spatulas factory direct to you."
    ];

    $arrayPhrasesKey = array_rand($arrayPhrases, 1);
    $phrase = $arrayPhrases[$arrayPhrasesKey];

?>

<style type="text/css">
    .phrases {
        position: relative;
        left: 125px;
    }
    .pushdown {
        background-color: #0062cc;
        color: yellow;
        margin-top: 20px;
        height: 90px;
    }
    .navbar-default .navbar-nav>li>a {
        color: #ffffff;
    }
    .navbar-nav>li>a {
        line-height: 56px;
    }
    .spatulaholder {
        width: 200px;
        height: 62px;
        background-color: #0062cc;
        position: relative;
        left: 35px;
    }
    .handle {
        width: 60px;
        height: 16px;
        border-radius: 5px;
        background-color: #000000;
        position: absolute;
        top: 23px;
        left: 10px;
        z-index: 2;
    }
    .stem {
        width: 72px;
        height: 10px;
        background-color: #d9d9d9;
        position: absolute;
        top: 26px;
        left: 50px;
    }
    .flatend {
        width: 60px;
        height: 42px;
        border-radius: 5px;
        background-color: #d9d9d9;
        position: absolute;
        top: 10px;
        left: 120px;
    }
    .rectangle {
        width: 40px;
        height: 6px;
        border-radius: 2px;
        background-color: #0062cc;
    }
    #rect1 {
        position: absolute;
        top: 6px;
        left: 10px;   
    }
    #rect2 {
        position: absolute;
        top: 18px;
        left: 10px;   
    }
    #rect3 {
        position: absolute;
        top: 30px;
        left: 10px;   
    }
</style>

<h3 class="phrases"><?= $phrase; ?></h3>
    
<nav class="navbar navbar-default pushdown">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <div class="spatulaholder">
                    <div class="handle"></div>
                    <div class="stem"></div>
                    <div class="flatend">
                        <div class="rectangle" id="rect1"></div>
                        <div class="rectangle" id="rect2"></div>
                        <div class="rectangle" id="rect3"></div>
                    </div>
                </div> <!-- end spatulaholder -->
            </a>
        </div> <!-- end navbar-header -->
        
        <!-- Collect the nav links, forms, and other content for toggling -->     
        <div class="collapse navbar-collapse" id="navbar">        
            <ul id="navig" class="nav navbar-nav navbar-right">
                <li><a href="ads.index.php">My Store</a></li>
                <li><a href="ads.index.php">Products</a></li>
                <li><a href="ads.index.php">Services</a></li>
                <li><a href="ads.index.php">Deals</a></li>
                <li><a href="ads.index.php">Sell Your Spatula</a></li>
                <li <?php if(!isset($_SESSION['Loggedinuser'])) {?>style="display:none"<?php }?>><a href="users.show.php">Your Profile</a></li>
                <li <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?>><a href="auth.login.php">Members, Log In!</a></li>
                <li <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?>><a href="users.create.php">Sign Up</a></li>
                <li><a href="meet.php">About ZTR</a></li>
            </ul>
        </div> <!--/.nav-collapse -->
    </div> <!-- end container fluid -->
</nav>