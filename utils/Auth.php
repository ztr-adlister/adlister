<?php
require_once '../utils/Log.php';

class Auth 
{
	public static $password = 'NEED PASSWORD KEY';

	public static function attempt($userName, $password){ 
		$log = new Log();

		if ($userName == 'guest' && password_verify($password, self::$password))
			{
				$_SESSION['LOGGED_IN_USER'] = $userName;
				$log->info("User {$userName} logged in.");
			}
				$log->error("User {$userName} failed to log in!");
	}

	public static function check()
	{
		if(isset($_SESSION['LOGGED_IN_USER']))
		{
			return true;
		} 
		return false;
	}
	public static function user()
	{
		return self::check($_SESSION['LOGGED_IN_USER']);
	} 
	public static function logout()
	{
		// Unset all of the session variables.
	    $_SESSION = array();
	    if (ini_get("session.use_cookies")) 
	    {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	        );
    	}	
	    session_destroy();
	}
}

?>