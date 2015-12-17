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
}



