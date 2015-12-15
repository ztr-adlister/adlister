<?php

// This is the Database Seeder file for users.

// Calls a file of the login CONSTANTS.
require_once 'adlister_login.php';

require_once 'db_connect.php';

$clearout = 'TRUNCATE contacts';

$dbc->exec($clearout);

$contacts = [
    ['username' => 'Zee', 'password' => 'zebra', 'email' => 'zee@ztr.com', 'boxcolor' => 'red'],
    ['username' => 'Reagan', 'password' => 'romeo', 'email' => 'reagan@ztr.com', 'boxcolor' => 'blue'],
    ['username' => 'Tony', 'password' => 'tango', 'email' => 'tony@ztr.com', 'boxcolor' => 'green']
];

$stmt = $dbc->prepare('INSERT INTO contacts (username, password, email, boxcolor) VALUES (:username, :password, :email, :boxcolor)');

foreach ($contacts as $contact) {
    $stmt->bindValue(':username', $contact['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $contact['password'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $contact['email'], PDO::PARAM_STR);
    $stmt->bindValue(':boxcolor', $contact['boxcolor'], PDO::PARAM_STR);
    
    $stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

// Echoing the connection status.
echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";