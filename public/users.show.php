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

// Redirects you to the login page if you aren't logged in
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}

// Grabs the user data
User::dbConnect();
$stmt = $dbc->prepare('SELECT * FROM users WHERE username = :username');
$stmt->bindValue(':username', $_SESSION['Loggedinuser'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$boxcolor = $user['boxcolor'];

// Grabs the ad data
$stmt1 = $dbc->prepare('SELECT * FROM ads WHERE user_id = :id');
$stmt1->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt1->execute();
$userads = $stmt1;

// Deletes your profile and all of your ads from the database
function deleteprofile($dbc)
{
    $deleteid = Input::get('id');
    $deletequery2 = $dbc->prepare('DELETE FROM ads WHERE user_id = :user_id');
    $deletequery = $dbc->prepare('DELETE FROM users WHERE id = :id');
    $deletequery->bindValue(':id', $deleteid, PDO::PARAM_INT);
    $deletequery2->bindValue(':user_id', $deleteid, PDO::PARAM_INT);
    $deletequery2->execute();
    $deletequery->execute();
    header("location: auth.logout.php");
    die();
}

// Deletes the specific ad you chose
function deletead($dbc)
{
    $deleteid = Input::get('adid');
    $deletequery = $dbc->prepare('DELETE FROM ads WHERE id = :id');
    $deletequery->bindValue(':id', $deleteid, PDO::PARAM_INT);
    $deletequery->execute();
    header("location: users.show.php");
    die();
}

// Decides when to run the deletion functions
if(Input::notempty('id')) {
    deleteprofile($dbc);
}
if(Input::notempty('adid')) {
    deletead($dbc);
}
?>
<!DOCTYPE html>
<!-- Carried over from the index -->
<html lang="en">
    <?php require_once '../views/header.php'; ?>
    <body class = "meetColor">
    <?php require_once '../views/navbar.php'; ?>
<!-- Your username, box, and icon -->
<div class="container">
<div class ="row">
    <div class ="col-md-12">
    <!-- Shows username, box, and icon -->
    	<h2 class ="show textinfrontofbackground">Hello, <?=$user['username'] ?>!</h2>
        <div class ="hidden-xs hidden-sm" id ="box" style ="background-color: <?=$boxcolor?>;"><br><br><i id ="icon" class ="fa fa-<?=$user['icon']?> fa-5x"></i></div>
    </div>
</div>

<!-- Ads the user has posted -->
<h3 class ="show textinfrontofbackground">Your Ads:</h3>
<div class ="row">
    <div class ="col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-2 showads">
        <ul><br>
        <!-- Shows the image, title, description, and price of every ad you have posted -->
            <?php foreach($userads as $advalue) {?>

            <!-- image -->
                <li><a class="hidden-xs hidden-sm" href="ads.show.php?id=<?=$advalue['id']?>"><img id="image" src ="img/<?=$advalue['image_url']?>" class="img-responsive" alt="Responsive image"></a></li>

            <!-- ad title -->
            <li><strong>Title:</strong><a href = "ads.show.php?id=<?=$advalue['id']?>"><?=$advalue['title']?></a></li>

            <!-- ad description -->
            <li><strong>Description:</strong> <?=$advalue['description']?></li>

            <!-- ad price -->
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>

            <!-- button to delete the ad -->
            <li><button class = "deleter" data-id="<?=$advalue['id']?>" data-name = "<?=$advalue['title']?>"><i class = "fa fa-trash"></i>Delete this Ad</button></li>
            <br><br><br>
            <?php } ?>
        </ul>
<!-- Buttons inside ad space -->
        <div class = "row">
            <div class = "col-md-6">
            <!-- Create an ad -->
                <button class = "btn btn-warning"><a href="ads.create.php" id = "createads"><i class = "fa fa-commenting-o"></i>Post a new Ad</a></button>
            </div>

            <div class = "col-md-6">
            <!-- Edit an ad -->
                <button class = "btn btn-success"><a href="ads.edit.php" id = "editads"><i class = "fa fa-pencil hidden-sm"></i>Edit an existing Ad</a></button>
            </div>
        </div>
    </div>
</div>
</div> <!-- End of the ad display-->
    	<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php"><i class = "fa fa-pencil"></i>Edit your profile</a>
        <br><br>
<!-- Logs you out -->
        <a class="show" id = "logout" href = "auth.logout.php"><i class = "fa fa-sign-out"></i>Log Out</a>
        <br><br><br><br><br>
<!-- Deletes your profile -->
        <a class="show" id="deleteprofile" data-id="<?=$user['id']?>" data-name="<?=$user['username']?>"><i class = "fa fa-trash"></i>Delete Profile</a>
        <br><br><br>
</div> <!-- end of container -->
    </body>
    <?php require_once '../views/footer.php'; ?>

    <!-- Stores the profile you want to delete -->
    <form method="POST" id="deletion">
        <input type = "hidden" name = "id" id="delete-id">
    </form>

    <!-- Stores the ad you want to delete -->
    <form method="POST" id = "addelete">
        <input type = "hidden" name = "adid" id ="delete-ad">
    </form>