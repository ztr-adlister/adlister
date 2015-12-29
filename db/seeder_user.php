<?php

// This is the Database Seeder file for users.

// Calls a file of the login CONSTANTS.
require_once 'adlister_login.php';

require_once 'db_connect.php';

require_once 'hashedpw.php';

$clearout = 'DELETE FROM users';

$dbc->exec($clearout);

$users = [
    ['username' => 'Zee', 'password' => $zeeHashed, 'email' => 'zee@ztr.com', 'boxcolor' => 'red', 'icon' => 'beer', 'phone' => '512-555-1234', 'reminder' => 'Stripey African Horse'],
    ['username' => 'Reagan', 'password' => $reaganHashed, 'email' => 'reagan@ztr.com', 'boxcolor' => 'blue', 'icon' => 'plane', 'phone' => '979-555-5678', 'reminder' => 'Wherefore art thou?'],
    ['username' => 'Tony', 'password' => $tonyHashed, 'email' => 'tony@ztr.com', 'boxcolor' => 'green', 'icon' => 'bullseye', 'phone' => '808-555-9012', 'reminder' => 'It takes two to...']
];

$stmt = $dbc->prepare('INSERT INTO users (username, password, email, boxcolor, icon, phone, reminder) VALUES (:username, :password, :email, :boxcolor, :icon, :phone, :reminder)');

foreach ($users as $user) {
    $stmt->bindValue(':username', $user['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':boxcolor', $user['boxcolor'], PDO::PARAM_STR);
    $stmt->bindValue(':icon', $user['icon'], PDO::PARAM_STR);
    $stmt->bindValue(':phone', $user['phone'], PDO::PARAM_STR);
    $stmt->bindValue(':reminder', $user['reminder'], PDO::PARAM_STR);

    $stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

// Echoing the connection status.
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";