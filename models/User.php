<?php

// PHP User file for the User model!

require_once 'Basemodel.php';

class User extends Model 
{
    protected static $table = 'users';

    public static function finduserbyusername($username)
    {
    	self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . static::$table . ' WHERE username = :username');
		$stmt->bindValue(':username', $username, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$instance = null;
		if ($result)
		{
			$instance = new static;
			$instance->attributes = $result;
		}
		return $instance;
    }

    public static function checkemail($email)
    {
    	self::dbConnect();
		$stmt = self::$dbc->prepare('SELECT * FROM ' . static::$table . ' WHERE email = :email');
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$instance = null;
		if ($result)
		{
			$instance = new static;
			$instance->attributes = $result;
		}
		return $instance;
    }
}
