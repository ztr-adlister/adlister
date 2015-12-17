<?php

    require_once '../utils/Auth.php';
    require_once '../utils/Input.php';
    require_once '../db/adlister_login.php';
    require_once '../models/User.php';

    function pageController()
    {
        require_once '../db/db_connect.php';

        session_start();
        // get the current session id
        $sessionId = session_id();

        $username = Auth::user();

        $user = User::finduserbyusername($username);

        // Uses the 'Submit A National Park' form to insert new values to the table and database.
        function insertAd($dbc, $user)
        {
            // Now calls on the Input class's getString and getDate methods with try catches.
            // Try catch create an array of errors for passing to the user in the HTML.
            $errorArray = [];

            try {
                $method = Input::getString('method', 1, 50);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errMethod'] = $error;
            }
            try {
                $image_url = Input::getString('image_url', 1, 50);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errImage'] = $error;
            }
            try {
                $title = Input::getString('title', 1, 50);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errTitle'] = $error;
            }
            try {
                $price = Input::getNumber('price', 0, 25000);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errPrice'] = $error;
            }
            try {
                $location = Input::getString('location', 1, 50);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errLoc'] = $error;
            }
            try {
                $description = Input::getString('description', 1, 500);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $errorArray['errDes'] = $error;
            }

            // If the $errorArray is not empty, this will return out of the method before binding values and executing below. The $errorArray returns with an array of strings.
            if (!empty($errorArray)) {
                return $errorArray;
            }

            $stmt = $dbc->prepare('INSERT INTO ads (user_id, method, image_url, title, price, location, description) VALUES (:user_id, :method, :image_url, :title, :price, :location, :description)');
            $stmt->bindValue(':user_id', $user->id, PDO::PARAM_STR);
            $stmt->bindValue(':method', $method, PDO::PARAM_STR);
            $stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':location', $location, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);

            $stmt->execute();
        }

        $errorArray = [''];
        $formMethod = '';
        $formImage = '';
        $formTitle = '';
        $formPrice = '';
        $formLoc = '';
        $formDes = '';
        $yellow = false;

        if (!empty($_POST)) {
            if ( Input::notEmpty('method') && Input::notEmpty('image_url') && Input::notEmpty('title') && Input::notEmpty('price') && Input::notEmpty('location') && Input::notEmpty('description') ) {
                $errorArray = insertAd($dbc, $user);
                if ($errorArray == []) {
                    $errorArray = ['Ad Submitted!'];
                } else {
                    $formMethod = Input::get('method');
                    $formImage = Input::get('image_url');
                    $formTitle = Input::get('title');
                    $formPrice = Input::get('price');
                    $formLoc = Input::get('location');
                    $formDes = Input::get('description');
                }
            } else {
                $errorArray = ['Please submit values for each data field.'];
                $yellow = true;
                $formMethod = Input::get('method');
                $formImage = Input::get('image_url');
                $formTitle = Input::get('title');
                $formPrice = Input::get('price');
                $formLoc = Input::get('location');
                $formDes = Input::get('description');
            }
        }

        return array(
            'user' => $user,
            'errorArray' => $errorArray,
            'yellow' => $yellow,
            'formMethod' => $formMethod,
            'formImage' => $formImage,
            'formTitle' => $formTitle,
            'formPrice' => $formPrice,
            'formLoc' => $formLoc,
            'formDes' => $formDes
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
            .red {
                color: #e60000; /* Makes the error exceptions red. */
            }
            .yellow {
                background-color: #ffffb3;
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
                    <h3>Create an Ad</h3>
                    <?php foreach ($errorArray as $err): ?>
                        <h4 class="red"><?= $err; ?></h4>
                    <?php endforeach; ?>
                    <form method="POST" action="ads.create.php">
                        <div class="row formmargin">
                            <div class="col-xs-6">    
                                <label >Email</label>
                                <input type="text" name="email" value="<?= $user->email; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-xs-6">
                                <label >Name</label>
                                <input type="text" name="name" value="<?= $user->username; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row formmargin">
                            <div class="col-xs-6">
                                <label >Method of Contact</label><br>
                                <div <?php if (isset($errorArray['errMethod']) || $yellow): ?> class="text-center yellow" <?php else: ?> class="text-center" <?php endif; ?>>
                                    <label class="radiomargin">
                                        <input type="radio" name="method" id="optionsRadio1" value="email"
                                            <?php if (isset($errorArray['errMethod']) || $yellow): ?> autofocus <?php endif; ?> 
                                            <?php if ($formMethod == 'email'): ?> checked <?php endif; ?>
                                        >
                                         By Email
                                    </label>
                                    <label class="radiomargin">
                                        <input type="radio" name="method" id="optionsRadio2" value="phone" <?php if ($formMethod == 'phone'): ?> checked <?php endif; ?>>
                                         By Phone
                                    </label>
                                    <label class="radiomargin">
                                        <input type="radio" name="method" id="optionsRadio3" value="text" <?php if ($formMethod == 'text'): ?> checked <?php endif; ?>>
                                         By Text
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6">                   
                                <label >Image URL</label>
                                <input type="text" name="image_url" value="<?= $formImage; ?>" <?php if (isset($errorArray['errImage']) || $yellow): ?> class="form-control yellow" autofocus<?php else: ?> class="form-control" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="row formmargin">
                            <div class="col-xs-6">                   
                                <label >Ad Title</label>
                                <input type="text" name="title" value="<?= $formTitle; ?>" <?php if (isset($errorArray['errTitle']) || $yellow): ?> class="form-control yellow" autofocus<?php else: ?> class="form-control" <?php endif; ?>>
                            </div>
                            <div class="col-xs-2">
                                <label >Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" name="price" value="<?= $formPrice; ?>" <?php if (isset($errorArray['errPrice']) || $yellow): ?> class="form-control yellow" autofocus<?php else: ?> class="form-control" <?php endif; ?>>
                                    <!-- <span class="input-group-addon">.00</span> -->
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label >Location</label>
                                <input type="text" name="location" value="<?= $formLoc; ?>" <?php if (isset($errorArray['errLoc']) || $yellow): ?> class="form-control yellow" autofocus<?php else: ?> class="form-control" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="row formmargin">
                            <div class="col-xs-12">
                                <label >Ad Text</label>
                                <textarea rows="7" name="description" <?php if (isset($errorArray['errDes']) || $yellow): ?> class="form-control yellow" autofocus<?php else: ?> class="form-control" <?php endif; ?>><?= $formDes; ?></textarea>
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </form> 
                </div> <!-- End col-md-8 -->
            </div> <!-- End row. -->

        </div> <!-- End container. -->

        <?php require_once '../views/footer.php'; ?>
    </body>
</html>