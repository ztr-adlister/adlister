<?php

    require_once '../models/Ad.php';
    require_once '../utils/Input.php';


    function pageController()
    {
        session_start();
        $adsArray = Ad::all();

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
            .fakeimg {
                width: 100px;
                height: 100px;
                background-color: gray;
            }
            table tr td {
                vertical-align: middle;
            }
        </style>
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <div class="container clearthetop">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav navbar-nav">
                        <li><a href ="ads.index.php">Ads Index</a></li>
                        <li><a href="ads.create.php">Post an Ad</a></li>
                        <li><a href = "ads.edit.php">Edit an Ad</a></li>
                    </ul>
                </div> <!-- End col-md-2 -->

                <div class="col-md-8">
                    <h3>All The Ads</h3>
                    <table class="table table-bordered">
                        <!-- <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Price</th>
                        </tr> -->
                        <?php foreach ($adsArray as $ad): ?>
                            <tr>
                                <td><img src="{$ad['img']}" class="img-responsive fakeimg" alt="Responsive image"></td>
                                <td><a href="ads.show.php?id=<?=$ad['id'];?>"><?= "{$ad['title']} in {$ad['location']}"; ?></a></td>
                                <td>$<?= "{$ad['price']}"; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </table>
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>