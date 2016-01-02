<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';

    function pageController()
    {
        session_start();
        $adsArray = Ad::all();

        $clickedcategories = Input::has('clickcategory') ? '%' . Input::get('clickcategory') . '%' : '%' ;
        $adsArray = Ad::findCategories($clickedcategories);

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

        $spotlight = $adsArray[array_rand($adsArray, 1)];

        return array(
            'adsArray' => $adsArray,
            'adId' => $adId,
            'loginstatus' => $loginstatus,
            'clickedcategories' => $clickedcategories,
            'spotlight' => $spotlight,
            'justCategoriesArrayUnique' => $justCategoriesArrayUnique
        );    
    }

    extract(pageController());

?>

<!DOCTYPE html>
<html lang="en">
    
    <?php require_once '../views/header.php'; ?>    
    
    <body class="meetColor">
        <?php require_once '../views/navbar.php'; ?>
        
        <div class="container">

            <div class="row">            
                <div class="col-lg-10 col-lg-offset-1 hidden-md hidden-sm hidden-xs text-center bottomline">
                    <p class="note"><span class="blue">NOTE TO BUYERS</span> Christmas delivery is no longer available. Orders will be shipped next week. <a class="blue" href="ads.deals.php">See details <i class="fa fa-chevron-right"></i></a></p>
                </div> <!-- End col-md-10 -->
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 hidden-lg text-center bottomline">
                    <p class="note"><span class="blue">NOTE TO BUYERS</span> <a class="blue" href="#">See details <i class="fa fa-chevron-right"></i></a></p>
                </div> <!-- End col-md-10 -->
            </div> <!-- End row. -->

            <div class="row">            
                <div class="col-md-2 hidden-xs hidden-sm text-center">
                    <div class="sidebar">
                        <p class="priceTag">Categories</p>
                        
                        <form method="GET" action="ads.index.php" class="form-horizontal">
                            <label class="forcategories">
                                <input type="radio" name="clickcategory" value="%" <?php if (Input::get('clickcategory') == '%'): ?> checked <?php endif; ?>>
                                 All Spatulas
                            </label>

                            <?php foreach ($justCategoriesArrayUnique as $category): ?>
                                <label class="forcategories">
                                    <input type="radio" name="clickcategory" value="<?= $category; ?>" <?php if (Input::get('clickcategory') == $category): ?> checked <?php endif; ?>>
                                     <?= $category; ?>
                                </label>
                            <?php endforeach; ?>
                        </form>

                    </div> <!-- End sidebar -->
                </div> <!-- End col-md-2 -->

                <div class="col-md-10 text-center">
                    <div class="bigboxtop hidden-xs hidden-sm">
                        <h1 class="boxtitle">Spatula Spotlight! <?= $spotlight['title']?></h1>
                    </div>
                    <div class="bigbox hidden-xs hidden-sm" style="background:black url(../img/<?= $spotlight['image_url']?>) center center repeat;background-size:contain;">
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