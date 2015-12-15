<?php
	require 'db_connect.php';
	require 'adlister_login.php';
	$dbc->exec('DROP TABLE IF EXISTS users');

	$query1 = 'CREATE TABLE users (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL,
		password VARCHAR(100) NOT NULL,
		email VARCHAR(100) NOT NULL,
		boxcolor VARCHAR(15), NOT NULL,
		PRIMARY KEY (id)
	)';

	$dbc->exec($query1);

	$dbc->exec('DROP TABLE IF EXISTS ads');

	$query2 = 'CREATE TABLE ads (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		image_url VARCHAR(1000) NOT NULL,
		title VARCHAR(100) NOT NULL,
		description TEXT NOT NULL,
		price DOUBLE NOT NULL,
		location VARCHAR(100),
		PRIMARY KEY (id)
	)';

	$dbc->exec($query2);
?>