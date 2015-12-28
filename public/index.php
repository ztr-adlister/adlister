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

        <title>ZTR Industries Ad Lister 3000</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
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
                /*overflow: auto;*/
            }
            .forimages {
                width: 270px;
                height: 210px;
                margin: 10px auto;
                overflow: hidden;
                background-color: gray;
            }
            .priceTag {
                background-color: #007bff;
                color:white;
            }
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <!-- <div class="container clearthetop">
            <div class="row">
                <div class="col-md-12">
                    <h2>The ZTR Industries Ad Lister 3000</h2>

                    <div id="hero" class="hero-shop background-image " style="background-image:url(//img0.          etsystatic.com/site-assets/homepage-carousel/toddborka.jpg)">
                        <div class="container1">
                            <h1>Shop from people around the world, our nationwide stores, and warehouses!</h1>
                        </div>

                            <div class="image-credit-wrap">
                                <div class="image-footer-container">
                                    <a class="" href="">
                                        <img src=""/>
                                        <div class="seller-name"><span class="featured-shop-name">ToddBorka</span>
                                        <br/>
                                        <em>Lyon, France</em>
                                    </a>   
                            </div>                
                </div> --> <!-- End col-md-12 -->

            <!-- <div class="row">
                <div class="col-md-12">
                    <h4>Categories</h4>
                </div> End col-md-12
            </div> --> <!-- End row. --> 

            <!-- <div class="row2">
                <div class="col-md-12 text-center">
                    <h3>Newest Ads</h3>

                    <?php foreach($ads as $ad): ?>
                            <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                            <?php if ( strlen($fullTitle) > 34 ): ?>                              
                            <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 34); ?> 
                            <?php else: ?>
                            <?php $adEllipsedTitle = $fullTitle; ?>
                            <?php endif; ?>

                        <div class="adSquare" title="<?= $fullTitle ?>">
                            <div class="forimages">
                                <img src="<?= $ad['image_url'] ?>" class="img-responsive" alt="Responsive image">
                            </div>    
                            <a href="ads.show.php?id=<?=$ad['id'];?>"><?= $adEllipsedTitle; ?></a>
                            <p class="priceTag"><?= $ad['price'] ?></p>
                        </div>    
                    <?php endforeach ?>   

                </div> --> <!-- End col-md-12 -->
            <!-- </div> --> <!-- End row. --> 
        <!-- </div> --> <!-- End container. -->




        <div class="bigBox">
            <div class="spatulaholder">
                <div class="handle">
                    <div class="handleshine"></div>
                </div>
                <div class="stem"></div>
                <div class="flatend">
                    <div class="rectangle" id="rect1"></div>
                    <div class="rectangle" id="rect2"></div>
                    <div class="rectangle" id="rect3"></div>
                </div>
            </div> <!-- end spatulaholder -->

            <div id="spiredBuilding">
                <div id="spiredSmallRect"></div>
                <div id="spire"></div>
            </div>    
            <div class="rectangles" id="rectangle3"></div>
            <div class="rectangles" id="rectangle4"></div>
            <div class="rectangles" id="rectangle5"></div>
            <div class="rectangles" id="rectangle6"></div>
            <div class="rectangles" id="rectangle7">
                <div id="triangleBuild1"></div></div>
            <div class="rectangles" id="rectangle8"></div>
            <div class="rectangles" id="rectangle9"></div>
            <div class="rectangles" id="rectangle10"></div>
            <div class="rectangles" id="rectangle11">
                <div id="triangleBuild2"></div></div>


        </div> <!-- End bigBox -->

        <?php require_once '../views/footer.php'; ?>

    </body>
</html>


