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
        <style type="text/css">
            .clearthetop {
                margin-top: 50px;
            }
            .adSquare {
                width: 200px;
                height: 200px;
                border: 1px solid #d9d9d9;
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
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop">
            <div class="row">
                <div class="col-md-1">
                </div> <!-- End col-md-2 -->

                <div class="col-md-10 text-center">
                    <h3>All The Ads (It's so flipping good!)</h3>
                    
                        <?php foreach ($adsArray as $ad): ?>

                                <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                                <?php if ( strlen($fullTitle) > 22 ): ?>
                                <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 22); ?> 
                                <?php else: ?>
                                <?php $adEllipsedTitle = $fullTitle; ?>
                                <?php endif; ?>

                            <div class="adSquare" title="<?= $fullTitle ?>">
                                <div class="forimages">
                                    <img src="img/micro.jpg" class="img-responsive" alt="Responsive image">
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