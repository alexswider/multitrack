<?php
	
	/**********************************************************************
	*  ezSQL initialisation for mySQL
	*/

	// Include ezSQL core
	include_once "../../shared/ez_sql_core.php";

	// Include ezSQL database specific component
	include_once "ez_sql_mysql.php";

	//include_once "../../shared/ez_sql_config.php";
	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	
	
	/**********************************************************************
	*  ezSQL demo for mySQL database

	INSERT INTO rooms (hostID, unlockedTracks, urk)
SELECT * FROM (SELECT '12333', '1233', '2323') AS tmp
WHERE NOT EXISTS (
    SELECT createdTime FROM rooms WHERE createdTime <= NOW( ) - INTERVAL 1 HOUR
) LIMIT 1;

	*/

	// Demo of getting a single variable from the db
	// (and using abstracted function sysdate)
class Rooms {	


	public static function CheckCreateUser($userId,$name,$path)
	{
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
		$strQuery="
				INSERT INTO users (name, fbId, ip,avatar ) 
   				SELECT '".$name."','".$userId."','127.0.0.0', '".$path."' FROM DUAL WHERE NOT EXISTS(SELECT fbId FROM users WHERE fbId = ".$userId.")
   				";
   		$result = $db->query($strQuery);

   		return $result;
	}

	public static function CreateRoom($userId, $hours= 1)
	{
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
		
//checing room ID in last Our
		$Q = "SELECT * FROM rooms 
			WHERE createdTime >= NOW( ) - INTERVAL 1 HOUR
			AND hostID = ".$userId."
			LIMIT 1";
		$results = $db->get_results($Q);

		foreach ( $results as $room ) {
   			  $ID = $room->id;
		}

		

		if($ID==null){
			$strQuery="
				INSERT INTO rooms (hostID, unlockedTracks, urk)
				VALUES (".$userId.", '1', 'shortURL')";
			$results = $db->query($strQuery);
			return $results;
		}else{
			return $ID;
		}
		
		
		//$roomID = $db->get_results($strQuery);
   	//return $roomID;

   	/*	
   	//	if($results==0)
   	//	{
   			//$roomId = $userId; //user is the host
   			$strQuery="
				INSERT INTO tracks (roomId, userId,trackNumber) 
   				SELECT '".$roomID."','".$userId."', '1' FROM DUAL WHERE NOT EXISTS(SELECT userId FROM tracks WHERE userId = ".$userId.")
   				";
   			$db->query($strQuery);

////SOLVE THIS 

   			$strQuery1="
	  			SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
				FROM rooms
				JOIN tracks T ON ( rooms.hostID = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.hostID = ".$roomId."
				AND createdTime >= NOW( ) - INTERVAL 1 HOUR
				ORDER BY T.trackNumber ASC 
				";
				
	  		$results = $db->get_results($strQuery1);
*/
		
		//return $results;

   		//}else{
   		//	return $results;
   		//}

	}



	public static function checkForExtraTracks($userUnlocked,$roomId){
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
		//checking ammount of unlocked tracks in room $roomId
	  	$roomUnlocked = $db->get_var("SELECT unlockedTracks FROM rooms WHERE hostID=".$roomId);

	  	if($userUnlocked<$roomUnlocked){
	  		$strQuery="
	  			SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
				FROM rooms
				JOIN tracks T ON ( rooms.hostID = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.hostID = ".$roomId."
				AND rooms.unlockedTracks > ".$userUnlocked."
				ORDER BY T.trackNumber ASC 
				";
	  		
	  		$results = $db->get_results($strQuery);
			return $results;
	  	}

		
	}



	public static function JoinByRoomID($userId,$roomId,$totalTracks,$hours = 1 )
	{
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
	//checking ammount of unlocked tracks in room $roomId

	  	$totalUnlocked = $db->get_var("SELECT unlockedTracks FROM rooms WHERE hostID=".$roomId);

	  	if($totalTracks>$totalUnlocked){
	///adding new track with user 
	  		$totalUnlocked++;//putting next track
	  		$var = strval($totalUnlocked)	;
	  		$strQuery="
				INSERT INTO tracks (roomId, userId,trackNumber) 
   				SELECT '".$roomId."','".$userId."', '".$var."' FROM DUAL WHERE NOT EXISTS(SELECT userId FROM tracks WHERE userId = ".$userId.")
   				";
   			$db->query($strQuery);
   	//updating room record with new unlockedTrack value 
   			$strUpdQuery="
				UPDATE rooms SET unlockedTracks = ".$var."
				WHERE hostID='".$roomId."'
				";
   			$db->query($strUpdQuery);


   	//pulling new sett of tracks from room 
   			$strQuery2 = "
				SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
				FROM rooms
				JOIN tracks T ON ( rooms.hostID = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.createdTime >= NOW( ) - INTERVAL ".$hours." HOUR 
				AND rooms.hostID = ".$roomId."
				ORDER BY T.trackNumber ASC ";
			$results = $db->get_results($strQuery2);
			
	    	return $results;
	  	}else{
	  		return "$totalTracks".$totalTracks."<$totalUnlocked:".$totalUnlocked;
	  	}

	}


}

?>