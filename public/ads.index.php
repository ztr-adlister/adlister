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

        $arrayCategories = Ad::showJustCategories();
        $justCategories = [];
        foreach ($arrayCategories as $key => $value) {
            array_push($justCategories, $value['categories']);
        }
        $justCategoriesString = implode(', ', $justCategories);
        $justCategoriesArray = explode(', ', $justCategoriesString);
        $justCategoriesArrayUnique = array_unique($justCategoriesArray);
        sort($justCategoriesArrayUnique);

        return array(
            'adsArray' => $adsArray,
            'adId' => $adId,
            'loginstatus' => $loginstatus,
            'justCategoriesArrayUnique' => $justCategoriesArrayUnique
        );    
    }

    extract(pageController());

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" href="img/icon.png">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ZTR Industries Ad Lister 3000</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Fugaz+One|Playball' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body {
                background-color: #F5F5F1;
            }
            .bottomline {
                margin-top: 10px;
                border-bottom: 2px solid #0062cc;
                margin-bottom: 20px;
            }
            .note {
                font-size: 18px;
            }
            .blue {
                color: #007bff;
            }
            .sidebar {
                width: 100%;
                background-color: #ffffff;
                border: 1px solid #007bff;
                border-radius: 5px;
                margin-bottom: 10px;
            }
            .priceTag {
                background-color: #007bff;
                color: white;
            }
            .forcategories {
                margin-left: 20px;
            }
            .bigbox {
                width: 600px;
                height: 225px;
                border: 1px solid #d9d9d9;
                background: green url(img/starspangledspatula.jpg) center center no-repeat;
                border-radius: 5px;
                margin: 0px auto 20px;
                position: relative;
                overflow: hidden;
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
        </style>
    </head>
    <body>

        <?php require_once '../views/navbar.php'; ?>
        
        <div class="container">

            <div class="row">            
                <div class="col-md-10 col-md-offset-1 text-center bottomline">
                    <p class="note"><span class="blue">NOTE TO BUYERS</span> Christmas delivery is no longer available. Orders will be shipped next week. <a class="blue" href="#">See details <i class="fa fa-chevron-right"></i></a></p>
                </div> <!-- End col-md-10 -->
            </div> <!-- End row. -->

            <div class="row">            
                <div class="col-md-2 hidden-xs hidden-sm">
                    <div class="sidebar">
                        <p class="priceTag text-center">Categories</p>
                        <?php foreach ($justCategoriesArrayUnique as $category): ?>
                            <p class="forcategories"><?= $category; ?></p>
                        <?php endforeach; ?>
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