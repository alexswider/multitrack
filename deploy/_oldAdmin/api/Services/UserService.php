<?php

class UserService
{	 	
  	public function __construct()
	{
		include_once("Config.php");
		include_once(ABS_PATH."includes/ez_sql_core.php");
		include_once(ABS_PATH."includes/ez_sql_mysql.php");
	}
	
	/**
	 * Gets wallposts
	 * @returns object with property success holding a value of true or false
	 */	
	public function checkUser($userName,$userPass)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			$updates = $db->get_results('SELECT * FROM users WHERE user="'.$userName.'" AND password="'.$userPass.'"', "ARRAY_A");
			
			$myObj->success = true;
			if($updates==null){$myObj->success = false;};
                        $myObj->updates = $updates;
		}
		else {
			$myObj->success = false;
			$myObj->errorId = 1;
			$myObj->message = "Klarte ikke koble til databasen";
		}
		return json_encode($myObj);
  	}
        
       
	
	
}

?>
