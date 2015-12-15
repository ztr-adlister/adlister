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
                        <li><a href="ads.show.php">Show one Ad</a></li>
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
                        <tr>
                            <td><img src="..." class="img-responsive fakeimg" alt="Responsive image"></td>
                            <td>The first item, stuff and things.</td>
                            <td>$$$</td>
                        </tr>
                        <tr>
                            <td><img src="..." class="img-responsive fakeimg" alt="Responsive image"></td>
                            <td>The second item, stuff and things.</td>
                            <td>$$$</td>
                        </tr>
                        <tr>
                            <td><img src="..." class="img-responsive fakeimg" alt="Responsive image"></td>
                            <td>The third item, stuff and things.</td>
                            <td>$$$</td>
                        </tr>   
                    </table>
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>