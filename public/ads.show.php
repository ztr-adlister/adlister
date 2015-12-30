<?php

    require_once '../models/Ad.php';
    require_once '../models/User.php';
    require_once '../utils/Input.php';

    function pageController()
    {
        session_start();
        if(!isset($_SESSION['Loggedinuser'])) {
            $loginstatus = "Members, Log In!";
        } else {
            $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        }
        $adId = Input::has('id') ? Input::get('id') : 1 ;
        $ad = Ad::find($adId);

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

    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop">
            <div class="row">
                <div class="col-md-2">
                </div> <!-- End col-md-2 -->

                <div class="col-md-8 text-center">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="titlemargin"><?= $ad->title ?></h3>
                            <img src="img/<?= $ad->image_url ?>" class="img-responsive adsshowimg" alt="Responsive image">
                        </div> <!-- End col-md-6 -->
                        <div class="col-md-6">
                            <h3>$<?= $ad->price ?> <span class="smallertext">List Price: $<?= round(($ad->price * 0.10) + $ad->price, 2); ?></span> <span class="saletext">ON SALE</span></h3>
                            <div class="twolines text-left">
                                <?php $randNum = rand(1, 15); ?>

                                <p>Q &amp; A (<?= $randNum; ?>)</p>
                            </div>
                            <div class="blankspace text-left">
                                <?php $userName = User::find($ad->user_id); ?>

                                <?php if ($ad->method == 'email'): ?>
                                    <p>contact Info: <?= $userName->username; ?> via <?= $ad->method; ?>: <span class="green"><?= $userName->email; ?></span> </p>
                                <?php else: ?>
                                    <p>contact Info: <?= $userName->username; ?> via <?= $ad->method; ?>: <span class="green"><?= $userName->phone; ?></span> </p>
                                <?php endif; ?>

                                <p><?= $avail; ?> available: <span class="redorange"><?= $ad->location; ?></span></p>
                            </div>
                            <div class="greybox text-left">
                                
                                <p><?= $ad->description ?></p>
                            </div>
                            <div class="blankspace smallgray text-left">
                                <p>categories: <?= $ad->categories ?></p>
                            </div>
                            <div class="finalnotes hidden-xs hidden-sm">
                                <div class="finalleft">
                                    <p>NOTES</p>
                                </div>
                                <div class="finalright text-left">
                                    <p> - Prices and availability may vary by store location.</p>
                                    <p> - For sale items, all sales are final. No returns.</p>
                                </div>
                            </div>
                        </div> <!-- End col-md-6 -->
                    </div> <!-- End row. -->
                    
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>