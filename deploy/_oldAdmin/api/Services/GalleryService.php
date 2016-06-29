<?php

class GalleryService
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
	public function getGallery($enddate = 0)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			$ekstra = $enddate > 0 ? "WHERE timestamp < ".$enddate:"";
			$updates = $db->get_results("SELECT * FROM gallery ".$ekstra." ORDER BY timestamp DESC LIMIT 30", "ARRAY_A");
			for ($i = 0;$i<count($updates);$i++) {
				if (!empty($updates[$i]['thumb_url'])) {
					$updates[$i]['picture_size'] = getimagesize("../gallery/thumbs/".$updates[$i]['thumb_url']);
				}
				$updates[$i]['message'] = utf8_encode($updates[$i]['description']);
				$updates[$i]['name'] = utf8_encode($updates[$i]['name']);
                                $updates[$i]['id'] = utf8_encode($updates[$i]['id']);
                                
				
				
			}
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
        public function getCampaign($id = 1)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			
			$updates = $db->get_results("SELECT * FROM gallery WHERE id=".$id , "ARRAY_A");
			//for ($i = 0;$i<count($updates);$i++) {
			//	$updates[$i]['message'] = utf8_encode($updates[$i]['description']);
			//	$updates[$i]['name'] = utf8_encode($updates[$i]['name']);
                        //        $updates[$i]['id'] = utf8_encode($updates[$i]['id']);
                                
			//}
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
        
        public function getLatestCampaign()
  	{
		$myObj = new stdClass();
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			
			$updates = $db->get_results("SELECT * FROM gallery ORDER BY timestamp DESC LIMIT 1" , "ARRAY_A");
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
        
        
        
        
        public function deleteCampaign($id = 1)
  	{
		$myObj = new stdClass();
		
		$db = new ezSQL_mysql(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
		
		if ($db)
		{
			
			$updates = $db->query("DELETE FROM gallery WHERE id=".$id );
			//for ($i = 0;$i<count($updates);$i++) {
			//	$updates[$i]['message'] = utf8_encode($updates[$i]['description']);
			//	$updates[$i]['name'] = utf8_encode($updates[$i]['name']);
                        //        $updates[$i]['id'] = utf8_encode($updates[$i]['id']);
                                
			//}
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
       
	
	
}

?>
