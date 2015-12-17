<?php

require_once 'Basemodel.php';

class Ad extends Model
{
	protected static $table= 'ads';

	public static function getNewest() {
		self::dbConnect();

		$query = 'SELECT * FROM ' . self::$table .' ORDER BY id DESC LIMIT 3';
		$stmt = self::$dbc->query($query);
		$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $ads;
	}
}



