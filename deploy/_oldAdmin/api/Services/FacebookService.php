<?php

class FacebookService
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
	public function getPosts($enddate = 0)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			$ekstra = $enddate > 0 ? "WHERE timestamp < ".$enddate:"";
			$updates = $db->get_results("SELECT * FROM updates ".$ekstra." ORDER BY timestamp DESC LIMIT 30", "ARRAY_A");
			for ($i = 0;$i<count($updates);$i++) {
				if (!empty($updates[$i]['local_picture'])) {
					$updates[$i]['picture_size'] = getimagesize("../facebook_images/".$updates[$i]['local_picture']);
				}
				$updates[$i]['message'] = utf8_encode($updates[$i]['message']);
				$updates[$i]['name'] = utf8_encode($updates[$i]['name']);
				
				if ($updates[$i]['type'] == "video") {
					if (strpos($updates[$i]['link'], "facebook") !== false) {
						$parsed_url = parse_url($updates[$i]['link']);
						parse_str($parsed_url['query'], $parsed_query);						
						$updates[$i]['video_id'] = $parsed_query['v'];
					}
				}
			}
			$myObj->success = true;
			$myObj->updates = $updates;
		}
		else {
			$myObj->success = false;
			$myObj->errorId = 1;
			$myObj->message = "Klarte ikke koble til databasen";
		}
		return json_encode($myObj);
  	}
	
	/**
	 * Gets site stats
	 * @returns object with property success holding a value of true or false
	 */	
	public function getStats($enddate = 0)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			
			$stats = $db->get_row("SELECT * FROM stats WHERE row=1", "ARRAY_A");
			
			$myObj->success = true;
			$myObj->stats = $stats;
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