<?php 

    require_once '../utils/Auth.php';
    require_once '../utils/Input.php';
    require_once '../db/adlister_login.php';
    require_once '../db/db_connect.php';
    
    function pageController()
    {
        session_start();
        // get the current session id
        $sessionId = session_id();
        if(!isset($_SESSION['Loggedinuser'])) {
            header('location: auth.login.php');
            die();
        }

        $loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";
        return array(
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
            .radiomargin {
                margin-left: 10px;
            }
            .formmargin {
                margin-bottom: 10px;
            }
            .methodmargin {
                margin-top: 15px;
                margin-bottom: 5px;
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
                    <h3>Edit an Ad</h3>

                    <form method="POST" action="ads.edit.php" class="form-inline">
                        <div class="form-group">
                            <label class="control-label"><?= Auth::user(); ?>'s Ads</label>
                            <!-- This foreach makes a list of all parks to display, without limit and offset that shows the park name but deletes by the park's id. -->
                            <select id="ad_to_edit" name="ad_to_edit" class="form-control">
                                <option value="" disabled selected> Select an Ad </option>
                                <?php foreach ($adsAllArray as $ad): ?>
                                    <option value="<?= "{$ad['id']}"; ?>"> <?= "{$ad['name']}"; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-default" type="submit">Load for Editing</button>
                    </form>

                    <form method="POST" action="ads.edit.php">
                        <div class="row formmargin">
                            <div class="col-xs-6">    
                                <label >Email</label>
                                <input type="text" name="email" value="..." class="form-control">
                            </div>
                            <div class="col-xs-6">
                                <label >Name</label>
                                <input type="text" name="name" value="..." class="form-control">
                            </div>
                        </div>
                        <div class="row methodmargin">
                            <div class="col-xs-12">
                                <label >Method of Contact</label>
                                <label class="radiomargin">
                                    <input type="radio" name="q2" id="optionsRadio1" value="byemail">
                                     By Email
                                </label>
                                <label class="radiomargin">
                                    <input type="radio" name="q2" id="optionsRadio2" value="byphone">
                                     By Phone
                                </label>
                                <label class="radiomargin">
                                    <input type="radio" name="q2" id="optionsRadio3" value="bytext">
                                     By Text
                                </label>
                            </div>
                        </div>
                        <div class="row formmargin">
                            <div class="col-xs-6">                   
                                <label >Ad Title</label>
                                <input type="text" name="title" value="..." class="form-control">
                            </div>
                            <div class="col-xs-2">
                                <label >Price</label>
                                <input type="text" name="price" value="..." class="form-control">
                            </div>
                            <div class="col-xs-4">
                                <label >Location</label>
                                <input type="text" name="location" value="..." class="form-control">
                            </div>
                        </div>
                        <div class="row formmargin">
                            <div class="col-xs-12">
                                <label >Ad Text</label>
                                <textarea class="form-control" rows="7"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </form> 
                    <form method="POST" action="ads.edit.php">
                        <button class="btn btn-danger" type="submit">Cancel</button>
                    </form>
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>