<?php
	require 'adlister_login.php';
	require 'db_connect.php';
	$dbc->exec('DROP TABLE IF EXISTS ads');
	$dbc->exec('DROP TABLE IF EXISTS users');

	$query1 = 'CREATE TABLE users (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL,
		password VARCHAR(100) NOT NULL,
		email VARCHAR(100) NOT NULL,
		boxcolor VARCHAR(15) NOT NULL,
		icon VARCHAR(50) NOT NULL,
		phone VARCHAR(20) NOT NULL,
		PRIMARY KEY (id)
	)';

	$dbc->exec($query1);


	$query2 = 'CREATE TABLE ads (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		user_id INT UNSIGNED NOT NULL,
		method VARCHAR(25) NOT NULL,
		image_url VARCHAR(1000) NOT NULL,
		title VARCHAR(100) NOT NULL,
		price DOUBLE NOT NULL,
		location VARCHAR(100),
		description TEXT NOT NULL,
		categories VARCHAR(100) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (user_id) REFERENCES users (id)
	)';

	$dbc->exec($query2);
?>