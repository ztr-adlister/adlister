<?php
/* TODO:
1) Redirect to login if user isn't logged in.
2) Feed in user info from database.
3) Make sure that the session that started on the login page is still running
*/
function pageController()
{
    $user = [
        [
            'id' => 1,
            'boxcolor' => 'blue',
            'username' => 'R-fresh',
            'email' => 'R-fresh@rfresh.com',
            'password' => 'hello'
        ]
    ];
    $userads = [
        [
            'id' => 1,
            'name' => 'Ray Ban Sunglasses',
            'description' => 'For a limited time, get these brand new Ray Bans!',
            'price' => 200.00
        ],
        [
            'id' => 2,
            'name' => 'Used Chewing Gum',
            'description' => 'I was chewing this gum and it lost its flavor...come on, man, I gotta pay rent!',
            'price' => 1.00
        ]
    ];
    $chosenads = [
        [ 
            'id' => 1,
            'username' => 'XxcryingprincessrainxX',
            'name' => 'Buncha Bananas',
            'description' => 'Its a bunch of bananas! So many bananas!',
            'price' => 5000.50
        ],
        [
            'id' => 2,
            'username' => 'theladieslovemeimnotalone9215098',
            'name' => 'Best of the Dire Straights',
            'description' => 'Best of the Dire Straights, now on a two disc set',
            'price' => 100.30
        ]
    ];

    return array (
        'user' => $user,
        'userads' => $userads,
        'chosenads' => $chosenads
    );
}

extract(pageController());
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
    </head>
    <?php require_once '../views/navbar.php'; ?>
    <body>
        <?php foreach($user as $userdata) {?>
    	<h2 class = "show">Hello, <?=$userdata['username']?>!</h2>
        <?php } ?>
        <div id = "box"></div>

<!-- Ads the user has posted -->
    	<h3 class = "show">Your Ads:</h3>
    	<ul class = "show">
    		<?php foreach($userads as $advalue) {?>
            <li><strong>Name:</strong> <?=$advalue['name']?></li>
            <li><strong>Description:</strong> <?=$advalue['description']?></li>
            <li><strong>Price:</strong> $<?=$advalue['price']?></li>
            <br>
            <?php } ?>
    	</ul>

<!-- Ads the user has responded to -->
    	<h3 class = "show">Ads you have responded to:</h3>
    	<ul class = "show">
    		<?php foreach($chosenads as $chosenthings) {?>
            <li><strong>Name:</strong> <?=$chosenthings['name']?></li>
            <li><strong>Description:</strong> <?=$chosenthings['description']?></li>
            <li><strong>Price:</strong> $<?=$chosenthings['price']?></li>
            <li><strong>Offered by:</strong> <?=$chosenthings['username']?></li>
            <br>
            <?php } ?>
    	</ul>
    	<br>
<!-- Takes you to the edit profile page -->
    	<a class = "show" id = "editprofile" href="users.edit.php">Edit your profile</a>
        <br><br>
    </body>
    <?php require_once '../views/footer.php'; ?>