<?php
require_once '../models/Ad.php';
require_once '../utils/Input.php';

    function pageController()
    {
        $ads = Ad::getNewest();

    // extract(pageController());
        session_start();

        if(!isset($_SESSION['Loggedinuser'])) {
            $loginstatus = "Members, Log In!";
        } else {
            $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        }

        $adId = Input::has('id') ? Input::get('id') : 1 ;
        return [
            'ads' => $ads,
            'loginstatus' => $loginstatus
        ];
    }

    extract(pageController());

    // var_dump($ads);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Spatula City</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Fugaz+One|Lobster' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href='../css/z.css'>

        <style type="text/css">

            .clearthetop {
                margin-top: 50px;
            }

            .adSquare {
                width: 300px;
                height: 300px;
                border: 1px solid gray;
                display: inline-block;
                margin: 0 0 10px 10px;
                position: relative;
                overflow: auto;
            }
            .adSquare img {
                margin: 0 auto;
                height: 240px;
                overflow: hidden;
            }

            .priceTag {
                background-color: #007bff;
                color:white;
            }
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop">
            <div class="row">
                <div class="col-md-12">
                    <div class="pictureHolder">
                        <span class="spatulaText hidden-sm hidden-xs">We have been flipping here since 1901!</span>
                        <img src="img/spatulaCity.png" class="img-responsive" alt="Responsive image">
                    </div> <!-- End of pictureHolder  -->    
                </div> <!-- End col-md-12 -->
            </div> <!-- End of row -->   

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Browse Our Newest Ads</h3>

                    <?php foreach($ads as $ad): ?>
                            <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                            <?php if ( strlen($fullTitle) > 34 ): ?>                              
                            <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 34); ?> 
                            <?php else: ?>
                            <?php $adEllipsedTitle = $fullTitle; ?>
                            <?php endif; ?>

                        <div class="adSquare" title="<?= $fullTitle ?>">
                            <img src="img/<?= $ad['image_url'] ?>" class="img-responsive" alt="Responsive image">
                            <a href="ads.show.php?id=<?=$ad['id'];?>"><?= $adEllipsedTitle; ?></a>
                            <p class="priceTag">$<?= $ad['price'] ?></p>
                        </div>    
                    <?php endforeach ?>   
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>

    </body>
</html>


