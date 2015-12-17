<?php
require_once '../models/Ad.php';

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
        return [
            'ads' => $ads
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
    </head>
    <body>
        <?php require_once '../views/navbar.php'; ?>

        <!-- <div id= "demo"></div> -->

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
                <div class="col-md-8">
                    <h3>Newest Ads</h3>
                    <ul class="list-group">
                        <?php foreach($ads as $ad): ?>
                            <li class="list-group-item">
                                <img src="<?= $ad['image_url'] ?>" class="img-responsive" alt="Responsive image">
                                <p><?= $ad['description'] ?></p>
                            </li> 
                        <?php endforeach ?>
                    </ul>    

                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 

            <div class="row">
                <div class="col-md-12">
                    <h4>Other Stuff of Some Import</h4>
                </div> <!-- End col-md-12 -->
            </div> <!-- End row. --> 
        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>

        <!-- // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTKLDdO9qbuZq4TSgKhyiuP8R-jrMo5uU"></script>
        // <script src="../js/geolocation.js"></script> -->
    </body>
</html>