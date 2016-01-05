<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';

    function pageController()
    {
        session_start();

        if(!isset($_SESSION['Loggedinuser'])) {
            $loginstatus = "Members, Log In!";
        } else {
            $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        }

        // Upon arrival at this page, this will load all the ads from the database.
        $adsArray = Ad::all();

        // Upon choosing a category, $clickcategories is set in $_GET. This variable is used to query the database.
        $clickedcategories = Input::has('clickcategory') ? '%' . Input::get('clickcategory') . '%' : '%' ;
        $adsArray = Ad::findCategories($clickedcategories);
        arsort($adsArray);

        // This portion of code gets all the ads' categories in one array.
        // The categories, which are strings (sometimes with multiple categories in it), 
        // are then put into the array by themselves. The array is imploded into a string and then exploded into an 
        // array again. This allows us to split the strings with multiple categories in them. 
        // The php array_unique removes duplicate category values and sort orders them by first letter.
        $arrayCategories = Ad::showJustCategories();
        $justCategories = [];
        foreach ($arrayCategories as $key => $value) {
            array_push($justCategories, $value['categories']);
        }
        $justCategoriesString = implode(', ', $justCategories);
        $justCategoriesArray = explode(', ', $justCategoriesString);
        $justCategoriesArrayUnique = array_unique($justCategoriesArray);
        sort($justCategoriesArrayUnique);

        // This randomly selects an ad to show in the spotlight spatula box.
        $spotlight = $adsArray[array_rand($adsArray, 1)];

        return array(
            'adsArray' => $adsArray,
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
                </div> <!-- End col-lg-10 -->
                <!-- The below div is a duplicate of the one just above here but for views on mobile devices. The above is hidden in this case. -->
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 hidden-lg text-center bottomline">
                    <p class="note"><span class="blue">NOTE TO BUYERS</span> <a class="blue" href="#">See details <i class="fa fa-chevron-right"></i></a></p>
                </div> <!-- End col-md-10 -->
            </div> <!-- End row. -->

            <div class="row">            
                <div class="col-md-2 hidden-xs hidden-sm text-center">
                    <div class="sidebar">
                        <p class="priceTag">Categories</p>
                        
                        <!-- This form filters the ads shown depending on which category is selected. -->
                        <form method="GET" action="ads.index.php" class="form-horizontal">
                            <label class="forcategories">
                                <input type="radio" name="clickcategory" value="%" <?php if (Input::get('clickcategory') == '%'): ?> checked <?php endif; ?>>
                                 All Spatulas
                            </label>

                            <!-- The categories are retrieved from the database and are all displayed by the foreach loop. -->
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
                    <div class="bigbox hidden-xs hidden-sm" style="background:black url(../<?= $spotlight['image_url']?>) center center repeat;background-size:contain;">
                    </div>
                    
                    <!-- The ads are retrieved from the database and are all displayed by the foreach loop. -->
                    <!-- $adEllipsedTitle cuts overly long titles and adds '...'. -->
                    <?php foreach ($adsArray as $ad): ?>
                            <?php $fullTitle = $ad['title'] . ' in ' . $ad['location']; ?>
                            <?php if ( strlen($fullTitle) > 22 ): ?>
                            <?php $adEllipsedTitle = substr_replace($fullTitle, '...', 22); ?> 
                            <?php else: ?>
                            <?php $adEllipsedTitle = $fullTitle; ?>
                            <?php endif; ?>
                        <div class="adSquare" title="<?= $fullTitle ?>">
                            <div class="forimages">
                                <img src="<?= $ad['image_url']; ?>" class="img-responsive" alt="Responsive image">
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