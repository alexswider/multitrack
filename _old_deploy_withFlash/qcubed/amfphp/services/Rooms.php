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
			WHERE createdTime >= NOW( ) - INTERVAL ".$hours." HOUR
			AND hostID = ".$userId."
			LIMIT 1";
		$results = $db->get_results($Q);

		if($results){
			foreach ( $results as $room ) {
	   			  $ID = $room->id;
			}
			
		}else{
			$strQuery="
				INSERT INTO rooms (id,hostID, unlockedTracks, urk)
				VALUES (NULL,".$userId.", 1 , 'shortURL')";
			$results2 = $db->query($strQuery);
			$Q = "SELECT * FROM rooms 
			WHERE createdTime >= NOW( ) - INTERVAL ".$hours." HOUR
			AND hostID = ".$userId."
			LIMIT 1";
			$results = $db->get_results($Q);
			foreach ( $results as $room ) {
	   			  $ID = $room->id;
			}
			
		}
		
		
// creting track for this room with user id
   			$strQuery="
				INSERT INTO tracks (roomId, userId,trackNumber) 
   				SELECT '".$ID."','".$userId."', '1' FROM DUAL WHERE NOT EXISTS(SELECT roomId FROM tracks WHERE roomId = '".$ID."')
   				";
   			$db->query($strQuery);

////SOLVE THIS 
   			$strQuery1="
	  			SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks,T.roomId as RoomId
				FROM rooms
				JOIN tracks T ON ( rooms.id = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.id = ".$ID."
				ORDER BY T.trackNumber ASC 
				";
				
	  		$results = $db->get_results($strQuery1);
   			return $results;
	}



	public static function checkForExtraTracks($userUnlocked,$roomId){
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
		//checking ammount of unlocked tracks in room $roomId
	  	$roomUnlocked = $db->get_var("SELECT unlockedTracks FROM rooms WHERE id=".$roomId);

	  	if($userUnlocked<$roomUnlocked){
	  		$strQuery="
	  			SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
				FROM rooms
				JOIN tracks T ON ( rooms.id = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.id = ".$roomId."
				AND T.trackNumber > ".$userUnlocked."
				ORDER BY T.trackNumber ASC 
				";
	  		
	  		$results = $db->get_results($strQuery);
			return $results;
	  	}else{
	  		return null;
	  		//return "$userUnlocked<$roomUnlocked:".$userUnlocked."<".$roomUnlocked;
	  	}

		
	}



	public static function JoinByRoomID($userId,$roomId,$totalTracks,$hours = 1 )
	{
		$db = new ezSQL_mysql('admin_multitrack', 'dupa.8', 'ming_multitrack');
//checking ammount of unlocked tracks in room $roomId

	  	$vars = $db->get_results("SELECT rooms.unlockedTracks as unlockedTracks, rooms.id as roomId, tracks.userId as userId
							FROM rooms, tracks
							WHERE rooms.id =".$roomId."
							AND tracks.roomId =".$roomId."
							AND createdTime >= NOW( ) - INTERVAL ".$hours." HOUR ");
//if room exist and or expired	  	
	  	if($vars){
		  	
		  	$userInList = false;
		  	foreach ( $vars as $track )
				{	
					$totalUnlocked  = $track->unlockedTracks;
					$roomID = $track->roomId;
					if($track->userId==$userId){
						$userInList = true;
					};
				}
		  	if($totalTracks>$totalUnlocked){
				error_log( "Addingtrack:TotalTracks:".$totalUnlocked );

		///adding new track with user 
		  		//$totalUnlocked = $totalUnlocked +1 ;//putting next track
		  		

		  		if($userInList){
		  			$var = $totalUnlocked ;
		  		}else{
		  			$var = $totalUnlocked+1;
		  		}


		  		error_log( "Addingtrack:var:".$var );

		  		$strQuery="
					INSERT INTO tracks (roomId, userId,trackNumber) 
	   				SELECT ".$roomID.",".$userId.", ".$var." FROM DUAL WHERE NOT EXISTS(SELECT roomId,userId FROM tracks WHERE roomId = ".$roomID." AND userId = ".$userId.")
	   				";
	   			$db->query($strQuery);
	   	//updating room record with new unlockedTrack value 
	   			$strUpdQuery="
					UPDATE rooms SET unlockedTracks  = ".$var."
					WHERE id=".$roomID;
	   			$db->query($strUpdQuery);


	   	//pulling new sett of tracks from room 
	   			
	   			$strQuery2 = "
					SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
					FROM rooms
					JOIN tracks T ON ( rooms.id = T.roomId ) 
					JOIN users U ON ( U.fbId = T.userId ) 
					WHERE rooms.id = ".$roomID."
					ORDER BY T.trackNumber ASC ";
				$results = $db->get_results($strQuery2);
				
		    	return $results;
		  	}else{
		  		return "$totalTracks".$totalTracks."<$totalUnlocked:".$totalUnlocked;
		  	}
	  	}else{
	  		return "EXPIRED";
	  	}

	}


}

?>