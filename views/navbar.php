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