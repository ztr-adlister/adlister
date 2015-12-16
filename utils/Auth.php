<?php
// require_once '../utils/Log.php';
require_once '../models/User.php';

class Auth 
{

	public static function attempt($username, $password){ 
		// if(!empty($_REQUEST[$username]) && !empty($_REQUEST[$password]))
		// {
		$user = User::finduserbyusername($username);
		if(empty($user)) {
			return $user;
		}
			// foreach($database as $user) {
		if($username == $user->username && $password == password_verify($password, $user->password)) {
			$_SESSION['Loggedinuser'] = $username;
		}

			
		// } 
		// return false;
	}

	public static function check()
	{
		if(isset($_SESSION['Loggedinuser']))
		{
			return true;
		} 
		return false;
	}
	public static function user()
	{
		$user = $_SESSION['Loggedinuser'];
		return $user;
	} 
	public static function logout()
	{
			    // Unset all of the session variables.
		$_SESSION = array();

		    // If it's desired to kill the session, also delete the session cookie.
		    // Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		    // Finally, destroy the session.
		session_destroy();
		// header('location: auth.login.php');
		// die();
		
	}
}

?>