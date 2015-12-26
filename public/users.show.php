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

// Sets the navbar status
$loginstatus = $_SESSION['Loggedinuser'] . " is logged in!";

// Redirects you to the login page if you aren't logged in
if (!Auth::check()) {
    header('Location: auth.login.php', true, 307);
    die();
}

// Grabs the necessary data from the database
User::dbConnect();
$stmt = $dbc->prepare('SELECT username, id, icon FROM users WHERE username = :username');
$stmt->bindValue(':username', $_SESSION['Loggedinuser'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your Profile</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/reagan.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">
        <style type="text/css">

        </style>
    </head>
    <?php require_once '../views/navbar.php'; ?>
    <body>
    	<h2 class = "show">Hello, <?=$user['username'] ?>!</h2>
        <div id = "box"><br><br><i class = "fa fa-<?=$user['icon']?> fa-5x"></i></div>

<!-- Ads the user has posted -->
    	<h3 class = "show">Your Ads:</h3>
    	<ul class = "show">
    		<?php foreach($userads as $advalue) {?>
            <li><strong>Title:</strong> <a href="ads.show.php?id=<?=$advalue['id']?>"><?=$advalue['title']?></a></li>
            <li><strong>Description:</strong> <?=$advalue['description']?></li>
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>
            <li><button class = "deleter" data-id="<?=$advalue['id']?>" data-name = "<?=$advalue['title']?>">Delete this Ad</button></li>
            <br>
            <?php } ?>
        <a href="ads.create.php" id = "createads"><i class = "fa fa-commenting-o"></i>Post a new Ad</a>
        <br><br><br><br>
        <a href="ads.edit.php" id = "editads"><i class = "fa fa-pencil"></i>Edit an existing Ad</a>
        <br><br><br>
        </ul>
    	<br>
<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php"><i class = "fa fa-pencil"></i>Edit your profile</a>
        <br><br>
<!-- Logs you out -->
        <a class="show" id = "logout" href = "auth.logout.php"><i class = "fa fa-sign-out"></i>Log Out</a>
        <br><br><br><br><br>
<!-- Deletes your profile -->
        <a class="show" id="deleteprofile" data-id="<?=$user['id']?>" data-name="<?=$user['username']?>"><i class = "fa fa-trash"></i>Delete Profile</a>
        <br><br><br>
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

    <script src = "js/jquery.js"></script>
    <script>
    "Use Strict";

    // The "Delete this Ad" button
    $(".deleter").click(function() {
        var adid = $(this).data("id");
        var adtitle = $(this).data("name");
        if (confirm("Are you sure you want to delete this ad: " + adtitle + "?")) {
            $("#delete-ad").val(adid);
            $("#addelete").submit();
        }
    });

    // The "Delete Profile" button
    $("#deleteprofile").click(function() {
        var profileid = $(this).data("id");
        var profilename = $(this).data("name");
        if (confirm("Are you sure you want to delete your profile, " +profilename + "?")) {
            $("#delete-id").val(profileid);
            $("#deletion").submit();
        }
    });
    </script>