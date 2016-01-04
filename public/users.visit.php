<?php
session_start();
require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';
require_once '../models/Basemodel.php';
require_once '../models/User.php';
require_once '../utils/Auth.php';
require_once '../utils/Input.php';
require_once '../models/Ad.php';
require_once 'css/userbox.php';

User::dbConnect();
$usertovisit = $_GET['usertovisit'];
if(User::finduserbyusername($usertovisit)) {
    $stmt = $dbc->prepare('SELECT id, username, boxcolor, icon FROM users WHERE username LIKE :username');
    $stmt->bindvalue(':username', $usertovisit, PDO::PARAM_STR);
    $stmt->execute();
    $visitinguser = $stmt->fetch(PDO::FETCH_ASSOC);
    $boxcolor = $visitinguser['boxcolor'];
    $stmt1 = $dbc->prepare('SELECT * FROM ads WHERE user_id = :id');
    $stmt1->bindValue(':id', $visitinguser['id'], PDO::PARAM_INT);
    $stmt1->execute();
    $visitingads = $stmt1;
} else {
    header('location: index.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once '../views/header.php'; ?>
    <body class = "meetColor">
   <?php require_once '../views/navbar.php';?>
    <h2 class = "show textinfrontofbackground"><?=$visitinguser['username']?>'s Ads</h2>
    <div id = "box" style = "background-color: <?=$boxcolor?>;"><br><br><i id = "icon" class = "fa fa-<?=$visitinguser['icon']?> fa-5x"></i></div>
 <!-- Ads the user has posted -->
 <div class = "row">
    <div class ="col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-2 showads">
    	<ul><br>
            <?php foreach($visitingads as $advalue) {?>
                <li><a class = "hidden-xs hidden-sm" href = "ads.show.php?id=<?=$advalue['id']?>"><img id = "image" src = "img/<?=$advalue['image_url']?>" class = "img-responsive" alt="Responsive image"></a></li>
            <li><strong>Title:</strong><a href = "ads.show.php?id=<?=$advalue['id']?>"><?=$advalue['title']?></a></li>
            <li><strong>Description:</strong> <?=$advalue['description']?></li>
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>
            <br><br><br>
            <?php } ?>
            </div>
            <div class = "row">
                <div class = "col-md-6 col-md-offset-2">
                    <button class = "btn btn-success"><a href="ads.index.php" id = "editads"><i class = "fa fa-pencil"></i>Back to Ads</a></button>
                    <br><br><br>
                </div>
            </div>
        </ul>
    </div>
 </div>
    	
</body>
<?php require_once '../views/footer.php';?>