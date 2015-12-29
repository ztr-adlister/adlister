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
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ZTR Industries Ad Lister 3000</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <style type="text/css">
            .clearthetop {
                margin-top: 50px;
            }
            .titlemargin {
                margin-bottom: 25px;
            }
            img {
                border: 1px solid #d9d9d9;
                box-shadow: 5px 5px 5px #d9d9d9;
                margin: 0 auto 20px;
            }
            .smallertext {
                font-size: 13px;
                font-weight: normal;
            }
            .saletext {
                font-size: 13px;
                color: #b30000;
                font-weight: bold;
            }
            .twolines {
                width: 100%;
                height: 50px;
                border-top: 2px solid #d9d9d9;
                border-bottom: 2px solid #d9d9d9;
                margin-bottom: 20px;
                font-size: 17px;
                color: #999999;
                line-height: 48px;
            }
            .blankspace {
                width: 100%;
                font-size: 17px;
                margin-bottom: 20px;
            }
            .green {
                color: #269900;
            }
            .redorange {
                color: #994c00;
            }
            .greybox {
                width: 100%;
                background-color: #d9d9d9;
                margin-bottom: 20px;
                padding: 20px;
            }
            .smallgray {
                font-size: 13px;
                color: #999999;
            }
            .finalnotes {
                width: 100%;
                height: 70px;
                position: relative;
                margin: 0 0 10px 0;
            }
            .finalleft {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 23%;
                height: 70px;
                border-right: 2px solid #d9d9d9;
                line-height: 68px;
                color: #999999;
            }
            .finalright {
                position: absolute;
                top: 14px;
                left: 98px;
                width: 70%;
                height: 70px;
                font-size: 10px;
                color: #999999;
            }
        </style>
    </head>
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
                            <img src="img/<?= $ad->image_url ?>" class="img-responsive" alt="Responsive image">
                        </div> <!-- End col-md-6 -->
                        <div class="col-md-6">
                            <h3>$<?= $ad->price ?> <span class="smallertext">List Price: $<?= round(($ad->price * 0.10) + $ad->price, 2); ?></span> <span class="saletext">ON SALE</span></h3>
                            <div class="twolines text-left">
                                <?php $randNum = rand(1, 15); ?>

                                <p>Q & A (<?= $randNum; ?>)</p>
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