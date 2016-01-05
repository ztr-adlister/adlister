<?php

    require_once '../models/Ad.php';
    require_once '../models/User.php';
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
        
        // $adId is set in $_GET to be used to determine which ad will be displayed.
        $adId = Input::has('id') ? Input::get('id') : 1 ;
        // Uses $adId to grab all the ad data from the database.
        $ad = Ad::find($adId);

        // A small array/array_rand section to randomly display ad availability in the ad write up.
        $availarray = ['not', 'limited quantities', 'in stock,'];
        $availkey = array_rand($availarray, 1);
        $avail = $availarray[$availkey];

        return array(
            'ad' => $ad,
            'adId' => $adId,
            'loginstatus' => $loginstatus,
            'avail' => $avail
        );   
    }

    extract(pageController());

?>

<!DOCTYPE html>
<html lang="en">

    <?php require_once '../views/header.php'; ?>

    <body class="meetColor">
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop textwhite">
            <div class="row">
                
                <div class="col-md-2">
                </div> <!-- End col-md-2 -->

                <div class="col-md-8 text-center">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="titlemargin"><?= $ad->title ?></h3>
                            <img src="<?= $ad->image_url ?>" class="img-responsive adsshowimg" alt="Responsive image">
                        </div> <!-- End col-md-6 -->
                        
                        <div class="col-md-6 blackbackground">
                            <!-- The list price is created through multiplying the price by 10% and then adding that to the price. -->
                            <h3>$<?= $ad->price ?> <span class="smallertext">List Price: $<?= round(($ad->price * 0.10) + $ad->price, 2); ?></span> <span class="saletext">ON SALE</span></h3>
                            
                            <div class="twolines text-left">
                                <!-- $randNum is just a random number for displaying next to Q and A. -->
                                <?php $randNum = rand(1, 15); ?>
                                <p>Q &amp; A (<?= $randNum; ?>)</p>
                            </div> <!-- End twolines -->
                            
                            <div class="blankspace text-left">
                                <!-- Line 74 gets the username of the owner of the ad. -->
                                <?php $userName = User::find($ad->user_id); ?>

                                <!-- The following PHP determine the user's method of contact and displays the correct value. -->
                                <?php if ($ad->method == 'email'): ?>
                                    <p>contact Info: <?= $userName->username; ?> via <?= $ad->method; ?>: <span class="green"><?= $userName->email; ?></span> </p>
                                <?php else: ?>
                                    <p>contact Info: <?= $userName->username; ?> via <?= $ad->method; ?>: <span class="green"><?= $userName->phone; ?></span> </p>
                                <?php endif; ?>

                                <p><?= $avail; ?> available: <span class="redorange"><?= $ad->location; ?></span></p>
                            </div> <!-- End blankspace -->
                            
                            <div class="greybox text-left">
                                <p><?= $ad->description ?></p>
                            </div> <!-- End greybox -->
                            
                            <div class="blankspace smallgray text-left">
                                <p>categories: <?= $ad->categories ?></p>
                                <!-- This anchor tag allows you to see all ads by that user. -->
                                <a class="visittheprofile" href="users.visit.php?usertovisit=<?=$userName->username?>"><?=$userName->username?>'s Other Ads</a>
                            </div> <!-- End smallgray -->
                            
                            <div class="finalnotes hidden-xs hidden-sm">
                                <div class="finalleft">
                                    <p>NOTES</p>
                                </div> <!-- End finalleft -->
                                <div class="finalright text-left">
                                    <p> - Prices and availability may vary by store location.</p>
                                    <p> - For sale items, all sales are final. No returns.</p>
                                </div> <!-- End finalright -->
                            </div> <!-- End finalnotes -->
                        
                        </div> <!-- End col-md-6 -->
                    </div> <!-- End row. -->
                    
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>