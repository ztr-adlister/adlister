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

<!-- tippytop is the phrase in the white section above the navbar. -->
<div class="tippytop hidden-xs hidden-sm">
    <h3 class="phrases"><?= $phrase; ?></h3>
</div> <!-- end tippytop -->

<!-- spatulaholder creates the spatula in the navbar using CSS. -->
<div class="spatulaholder hidden-xs hidden-sm">
    <div class="handle"></div>
    <div class="stem"></div>
    <div class="flatend">
        <div class="rectangle" id="rect1"></div>
        <div class="rectangle" id="rect2"></div>
        <div class="rectangle" id="rect3"></div>
    </div>
</div> <!-- end spatulaholder -->

<!-- customnav creates the navbar in medium and large views. -->
<nav class="customnav">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4 text-center col-sm-7 col-xs-9">
                <a class="logo" href="index.php">Spatula City</a>
            </div> <!-- end col-md-4 -->             

            <!-- This portion of the navbar gets hidden in small and extra small views. -->
            <!-- The php code determines if someone is logged in, and then shows the appropriate content. -->
            <div class="col-md-8 text-center hidden-xs hidden-sm"> 
                <a href="ads.index.php">Products</a>
                <a href="ads.deals.php">Deals</a>
                <?php if(isset($_SESSION['Loggedinuser'])): ?><a href="ads.create.php">Sell Your Spatula</a><?php else: ?><a href="auth.login.php">Members, Log In!</a><?php endif; ?>
                <a <?php if(!isset($_SESSION['Loggedinuser'])) {?>style="display:none"<?php }?> href="users.show.php">Your Profile</a>
                <a <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?> href="users.create.php">Sign Up</a>
                <a href="store.php">Commercial/Store</a>
                <a href="meet.php">About Spatula City</a>
            </div> <!-- end col-md-8 -->

            <!-- This replaces the above links in small and extra small views. -->
            <!-- By clicking on the fa-bars, a toggling navbar is shown. -->
            <div class="col-sm-5 col-xs-3 hidden-md hidden-lg text-center">
                <i class="fa fa-bars"></i>
            </div> <!-- end col-sm-5 col-xs-3 -->

        </div> <!-- end row -->
    </div> <!-- end container fluid -->
</nav>

<!-- secondarynav is the toggling part of the navbar in small and extra small views. -->
<!-- The php code determines if someone is logged in, and then shows the appropriate content. -->
<div class="secondarynav hidden-md hidden-lg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12 hidden-md hidden-lg text-center">
                <a href="ads.index.php"><i class="fa fa-product-hunt"></i> Products</a>
                <a <?php if(!isset($_SESSION['Loggedinuser'])) {?>style="display:none"<?php }?> href="users.show.php"><i class="fa fa-user"></i> Your Profile</a>
                <?php if(isset($_SESSION['Loggedinuser'])): ?><a href="ads.create.php"><i class="fa fa-money"></i> Sell</a><?php else: ?><a href="auth.login.php"><i class="fa fa-user"></i> Log In</a><?php endif; ?>
                <a <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?> href="users.create.php"><i class="fa fa-sign-in"></i> Sign Up</a>
                <a href="meet.php"><i class="fa fa-info-circle"></i> About</a>
            </div> <!-- end col-sm-12 -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end secondarynav -->