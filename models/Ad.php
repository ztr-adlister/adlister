<?php

require_once 'Basemodel.php';

class Ad extends Model
{
	protected static $table= 'ads';

	public static function findAllAdsByUserId($user_id)
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . static::$table . ' WHERE user_id = :user_id');
		$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public static function getNewest() {
		self::dbConnect();

		$query = 'SELECT * FROM ' . self::$table .' ORDER BY id DESC LIMIT 3';
		$stmt = self::$dbc->query($query);
		$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $ads;
	}

	public static function findCategories($categories)
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . self::$table . ' WHERE categories LIKE :categories');
		$stmt->bindValue(':categories', $categories, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public static function showJustCategories()
	{
		self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT categories FROM ' . self::$table . ' GROUP BY categories ASC');
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}



