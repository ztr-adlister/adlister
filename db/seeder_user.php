<?php

// This is the Database Seeder file for users.

// Calls a file of the login CONSTANTS.
require_once 'adlister_login.php';

require_once 'db_connect.php';

require_once 'hashedpw.php';

$clearout = 'DELETE FROM users';

$dbc->exec($clearout);

$users = [
    ['username' => 'Zee', 'password' => $zeeHashed, 'email' => 'zee@ztr.com', 'boxcolor' => 'red', 'icon' => 'beer'],
    ['username' => 'Reagan', 'password' => $reaganHashed, 'email' => 'reagan@ztr.com', 'boxcolor' => 'blue', 'icon' => 'plane'],
    ['username' => 'Tony', 'password' => $tonyHashed, 'email' => 'tony@ztr.com', 'boxcolor' => 'green', 'icon' => 'bullseye']
];

$stmt = $dbc->prepare('INSERT INTO users (username, password, email, boxcolor, icon) VALUES (:username, :password, :email, :boxcolor, :icon)');

foreach ($users as $user) {
    $stmt->bindValue(':username', $user['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':boxcolor', $user['boxcolor'], PDO::PARAM_STR);
    $stmt->bindValue(':icon', $user['icon'], PDO::PARAM_STR);

    $stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

// Echoing the connection status.
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";