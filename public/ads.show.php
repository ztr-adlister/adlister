<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';

    function pageController()
    {

        $adId = Input::has('id') ? Input::get('id') : 1 ;
        $ad = Ad::find($adId);

        return array(
            'ad' => $ad,
            'adId' => $adId
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
            .fakeimg {
                width: 300px;
                height: 300px;
                background-color: gray;
            }
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav navbar-nav">
                        <li><a href ="ads.index.php">Ads Index</a></li>
                        <li><a href="ads.create.php">Post an Ad</a></li>
                        <li><a href = "ads.edit.php">Edit an Ad</a></li>
                    </ul>
                </div> <!-- End col-md-2 -->

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><?= $ad->title ?></h3>
                        </div> <!-- End col-md-6 -->
                        <div class="col-md-3">
                            <h3>$<?= $ad->price ?></h3>
                        </div> <!-- End col-md-3 -->
                        <div class="col-md-3">
                            <h3><?= $ad->location ?></h3>
                        </div> <!-- End col-md-3 -->
                    </div> <!-- End row. -->
                    <div class="row">
                        <div class="col-md-12">
                            <img src="$ad->img_url" class="img-responsive fakeimg" alt="Responsive image">
                            <p><?= $ad->description ?></p>
                        </div> <!-- End col-md-12 -->
                    </div> <!-- End row. -->
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>