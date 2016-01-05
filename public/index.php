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

        $arrayCategories = Ad::showJustCategories();
        $justCategories = [];
        foreach ($arrayCategories as $key => $value) {
            array_push($justCategories, $value['categories']);
        }
        $justCategoriesString = implode(', ', $justCategories);
        $justCategoriesArray = explode(', ', $justCategoriesString);
        $justCategoriesArrayUnique = array_unique($justCategoriesArray);
        sort($justCategoriesArrayUnique);

        return [
            'ads' => $ads,
            'loginstatus' => $loginstatus,
            'justCategoriesArrayUnique' => $justCategoriesArrayUnique
        ];
    }

    extract(pageController());

    // var_dump($ads);

?>

<!DOCTYPE html>
<html lang="en">
    <?php require_once '../views/header.php'; ?>

    <body class="meetColor">
        <?php require_once '../views/navbar.php'; ?>

        <div class="container landingPageclearthetop">
            <div class="row">
                <div class="col-md-12">
                    <div class="pictureHolder">
                        <span class="spatulaText hidden-sm hidden-xs">We have been flipping here since 1901!</span>
                        <img src="img/spatulaCity.png" class="img-responsive" alt="Responsive image">
                    </div> <!-- End of pictureHolder  -->    
                </div> <!-- End col-md-12 -->
            </div> <!-- End of row -->     

            <div class="row">
                <div class="col-md-2 text-center">
                    <div class="sidebar indexSideBar">
                        <p class="priceTag text-center">Categories</p>
                         <a href="ads.index.php" class="catSelect hidden-sm hidden-xs">All Spatulas</a>
                         <a href="ads.index.php" class="catSelect2 hidden-md hidden-lg">All Spatulas</a>
                        <?php foreach ($justCategoriesArrayUnique as $category): ?>
                            <a href="ads.index.php?clickcategory=<?=$category;?>" class="catSelect hidden-sm hidden-xs"><?= $category; ?></a>
                            <a href="ads.index.php?clickcategory=<?=$category;?>" class="catSelect2 hidden-md hidden-lg"><?= $category; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div> <!-- End col-md-2 -->    
                <div class="col-md-10 text-center">
                    <h1 id="browseAdsText">Browse Our Newest Spatulas!!</h1>

                    <?php foreach($ads as $ad): ?>
                            <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                            <?php if ( strlen($fullTitle) > 34 ): ?>                              
                            <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 34); ?> 
                            <?php else: ?>
                            <?php $adEllipsedTitle = $fullTitle; ?>
                            <?php endif; ?>

                        <div class="landingPageadSquare" title="<?= $fullTitle ?>">
                            <img src="<?= $ad['image_url'] ?>" class="img-responsive" alt="Responsive image">
                            <a href="ads.show.php?id=<?=$ad['id'];?>"><?= $adEllipsedTitle; ?></a>
                            <p class="landingPagepriceTag">$<?= $ad['price'] ?></p>
                        </div>    
                    <?php endforeach ?>   
                </div> <!-- End col-md-10 -->    
            </div> <!-- End row. --> 
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>

    </body>
</html>


