<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';

    function pageController()
    {
        session_start();
        $adsArray = Ad::all();

        arsort($adsArray);

        if(!isset($_SESSION['Loggedinuser'])) {
            $loginstatus = "Members, Log In!";
        } else {
            $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        }

        $adId = Input::has('id') ? Input::get('id') : 1 ;

        return array(
            'adsArray' => $adsArray,
            'adId' => $adId,
            'loginstatus' => $loginstatus
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
        <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">
        <style type="text/css">
            body {
                background-color: #F5F5F1;
            }
            .bluetop {
                width: 100%;
                height: 120px;
                background-color: #007bff;
                color: #ffffff;
                position: relative;
            }
            .clearthetop {
                margin-top: 14px;
            }
            .titlespace {
                position: absolute;
                top: 50px;
                width: 100%;
                height: 70px;
                border-top: 2px solid #0062cc;
                border-bottom: 2px solid #0062cc;
                background-color: #007bff;
                color: #ffffff;
            }
            .lineheight1 {
                line-height: 28px;
            }
            .lineheight2 {
                line-height: 47px;
            }
            .lineheight3 {
                line-height: 68px;
            }
            .adSquare {
                width: 200px;
                height: 200px;
                border: 1px solid #d9d9d9;
                background-color: #ffffff;
                border-radius: 5px;
                display: inline-block;
                margin: 0 10px 20px 10px;
                position: relative;
                overflow: auto;
            }
            .forimages {
                width: 170px;
                height: 125px;
                margin: 10px auto;
                overflow: hidden;
            }
            /*img {
                margin-top: -20%;
            }*/
            .priceTag {
                background-color: #007bff;
                color: white;
            }
            .note {
                font-size: 18px;
            }
            .blue {
                color: #007bff;
            }
            .bottomline {
                border-bottom: 2px solid #007bff;
                margin-bottom: 20px;
            }
            .sidebar {
                height: 190px;
                width: 100%;
                background-color: #ffffff;
                border: 1px solid #007bff;
                border-radius: 5px;
                margin-bottom: 10px;
                /*margin: 0 auto;*/
                /*display: inline-block;*/
            }
            .forcategories {
                margin-left: 20px;
            }
            .bigbox {
                width: 600px;
                height: 225px;
                border: 1px solid #d9d9d9;
                background: green url(img/starspangledspatula.jpg) center center no-repeat;
                /*background-color: #007bff;*/
                border-radius: 5px;
                /*display: inline-block;*/
                /*margin: 0 10px 20px 10px;*/
                margin: 0px auto 20px;
                position: relative;
                overflow: auto;
            }
            .boxtitle {
                position: absolute;
                top: 3px;
                left: 102px;
                color: #007bff;
                font-weight: bold;
            }
            .boxdescription {
                position: absolute;
                top: 177px;
                left: 1px;
            }
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="bluetop">
            <div class="titlespace">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <h2 class="lineheight1">Spatula City</h2>
                    </div> <!-- End col-md-3 -->
                    <div class="col-md-7 text-center hidden-xs hidden-sm">
                        <h4 class="lineheight2"><em>"We sell spatulas, and that's all!"</em></h4>
                    </div> <!-- End col-md-7 -->
                    <div class="col-md-2 text-center hidden-xs hidden-sm">
                        <p class="lineheight3">Tulsa, OK</p>
                    </div> <!-- End col-md-2 -->        
                </div> <!-- End row. -->
            </div> <!-- End titlespace. -->
        </div> <!-- End bluetop. -->
        
        <div class="container clearthetop">

            <div class="row">            
                <div class="col-md-12 text-center bottomline">
                    <p class="note"><span class="blue">NOTE TO BUYERS</span> Christmas delivery is no longer available. Orders will be shipped next week. <a class="blue" href="#">See details <i class="fa fa-chevron-right"></i></a></p>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. -->

            <div class="row">            
                <div class="col-md-2 hidden-xs hidden-sm">
                    <div class="sidebar">
                        <p class="priceTag text-center">Categories</p>
                        <p class="forcategories">Antique</p>
                        <p class="forcategories">Geeky</p>
                        <p class="forcategories">Metal</p>
                        <p class="forcategories">Plastic</p>
                        <p class="forcategories">Wooden</p>
                    </div>
                    <div class="sidebar">
                        <p class="priceTag text-center"><em>"It's so flipping good!"</em></p>
                        <p class="forcategories">Something</p>
                        <p class="forcategories">Something</p>
                        <p class="forcategories">Something</p>
                        <p class="forcategories">Something</p>
                        <p class="forcategories">Something</p>
                    </div>
                </div> <!-- End col-md-2 -->

                <div class="col-md-10 text-center">
                    <div class="bigbox hidden-xs hidden-sm">
                        <h1 class="boxtitle">Spatula Spotlight!</h1>
                        <p class=" boxdescription">The Star Spangled Spatula is perfect for Indepence Day BBQs! Get yours today, 50% off. Supplies are limited.</p>
                    </div>
                    
                        <?php foreach ($adsArray as $ad): ?>
                                <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                                <?php if ( strlen($fullTitle) > 22 ): ?>
                                <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 22); ?> 
                                <?php else: ?>
                                <?php $adEllipsedTitle = $fullTitle; ?>
                                <?php endif; ?>
                            <div class="adSquare" title="<?= $fullTitle ?>">
                                <div class="forimages">
                                    <img src="img/<?= $ad['image_url']; ?>" class="img-responsive" alt="Responsive image">
                                </div>
                                <a href="ads.show.php?id=<?=$ad['id'];?>"><?= $adEllipsedTitle; ?></a>
                                <p class="priceTag">$<?= "{$ad['price']}"; ?></p>
                            </div>
                        <?php endforeach; ?>
                        
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>