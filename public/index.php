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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <style type="text/css">

            .adSquare {
                width: 300px;
                height: 300px;
                border: 1px solid gray;
                display: inline-block;
                margin: 0 0 10px 10px;
                /*overflow: auto;*/
            }
            .squareText {
                width: 290px;
                height: 290px;
                /*border: 1px solid gray;*/
                display: table-cell;
                vertical-align: bottom;
                /*margin: 0 0 10px 10px;*/
          /*      overflow: auto;*/
            }
            .priceTag {
                background-color: #007bff;
                color:white;
            }
            .fakeimg {
                width: 270px;
                height: 210px;
                background-color: gray;
                margin: 10px auto;
            }  
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>The ZTR Industries Ad Lister 3000</h2>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

            <div class="row">
                <div class="col-md-2">
                    <h4>Other Stuff of Some Import</h4>
                    <form method="POST" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Search</label>
                            <div class="col-sm-6">
                                <input type="text" name="description" value="..." class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </form>
                </div> <!-- End col-md-12 -->
                <div class="col-md-10 text-center">
                    <h3>Newest Ads</h3>

                    <?php foreach($ads as $ad): ?>
                        <div class="adSquare">
                                <img src="<?= $ad['image_url'] ?>" class="img-responsive fakeimg" alt="Responsive image">
                                <div class="squareText">
                                    <a href="ads.show.php?id=<?=$ad['id'];?>"><?= "{$ad['title']} in {$ad['location']}"; ?></a>
                                    <p class="priceTag"><?= $ad['price'] ?></p>
                                </div>
                        </div>    
                    <?php endforeach ?>   

                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

            <div class="row">
                <div class="col-md-12">
                    <h4>Categories</h4>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>

    </body>
</html>