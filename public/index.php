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
    <head>
        <link rel="icon" type="image/png" href="img/icon.png">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spatula City: Landing Page</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Fugaz+One|Lobster' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href='../css/z.css'>

    </head>
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
                    <div class="sidebar">
                        <p class="priceTag text-center">Categories</p>
                        <?php foreach ($justCategoriesArrayUnique as $category): ?>
                            <p class="forcategories"><?= $category; ?></p>
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
                            <img src="img/<?= $ad['image_url'] ?>" class="img-responsive" alt="Responsive image">
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


