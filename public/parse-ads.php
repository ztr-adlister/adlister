<?php

require_once '../db/adlister_login.php';
require_once '../db/db_connect.php';

$clearData = 'TRUNCATE ads';

$dbc->exec($clearData);

// This function reads the file and turns each line into an element in an array.
function readTheFile($filename) 
{
    $handle = fopen($filename, 'r');
    $contents = fread($handle, filesize($filename));
    $contentsString = trim($contents);
    $contentsArray = explode("\n", $contentsString);
    fclose($handle);
    return $contentsArray;
}

function cutOne($contentsArray)
{
    array_shift($contentsArray);
    return $contentsArray;
}

// This function takes the lines of string data and turns each one into an array of data.
// The array is now an array of arrays.
function reorderArray($contentsArray)
{
    foreach ($contentsArray as $index => $value) {
        $valueArray = explode('", "', $value);
        unset($contentsArray[$index]);
        $contentsArray[$index]['title'] = substr($valueArray[0], 1);
        $contentsArray[$index]['price'] = $valueArray[1];
        $contentsArray[$index]['location'] = $valueArray[2];
        $contentsArray[$index]['description'] = $valueArray[3];
        $contentsArray[$index]['image_url'] = $valueArray[4];
        $contentsArray[$index]['method'] = substr($valueArray[5], 0, -1);
    }
    return $contentsArray;
}

// Each function is called and saved as $contentsArray to cut down on variables. 
// Each time the updated version of the array is saved over the previous array of the same name.
$contentsArray = readTheFile('data_ads1.txt');
$contentsArray = cutOne($contentsArray);
$contentsArray = reorderArray($contentsArray);

print_r($contentsArray);

$query = "INSERT INTO ads (user_id, method, image_url, title, price, location, description) 
            VALUES (:user_id, 
                :method,
                :image_url,
                :title, 
                :price, 
                :location, 
                :description)";

$stmt = $dbc->prepare($query);

foreach ($contentsArray as $ad) {
    $stmt->bindValue(':user_id', rand(1, 3), PDO::PARAM_INT);
    $stmt->bindValue(':method', $ad['method'], PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $ad['image_url'], PDO::PARAM_STR);
    $stmt->bindValue(':title', $ad['title'], PDO::PARAM_STR);
    $stmt->bindValue(':price', $ad['price'], PDO::PARAM_STR);
    $stmt->bindValue(':location', $ad['location'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
    $stmt->execute();

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";