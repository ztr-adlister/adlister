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
}




