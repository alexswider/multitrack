<?php
require_once '../../qcubed.inc.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RoomService extends Rooms{
    
    public static function loadById($id)

	{

		$resultInfo = parent::LoadById($id); 

		$arrayData = array();

		if (is_object($resultInfo)) {
			foreach ($resultInfo as $var => $value) {
			$arrayData[$var] = $value;
			}
			return $arrayData;
		} elseif (is_array($resultInfo)) {
			foreach ($resultInfo as $var => $value) {
				if (is_object($value)) {
					$arrayData[$var] = $value->Id;						
				} else {
					$arrayData[$var] = $value;
				}
			}
			return $arrayData;
		} else {
		    return false;
		}

	}

	


	public static function CreateRoom($userId,$tracksUnlocked=1)/*{{{*/
	{
			$room = new RoomsGen();
			$room->HostID 			= $userId;
			$room->UnlockedTracks 	= $tracksUnlocked;
			$room->Urk 				= "shortURL";
//$sample->SubmitDate = strtotime('22-09-2008');;        
            if (is_numeric($room->Save(true))) {
                return $room->Id;
			} else {
				return false;	
			}
	}


	public  function GetTracksByRoomID($roomId,$hours=4)
	{
	  	
	    	$strQuery = "
				SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
				FROM rooms
				JOIN tracks T ON ( rooms.hostID = T.roomId ) 
				JOIN users U ON ( U.fbId = T.userId ) 
				WHERE rooms.createdTime >= NOW( ) - INTERVAL ".$hours." HOUR 
				AND rooms.hostID = ".$roomId."
				ORDER BY T.trackNumber ASC ";
			$objDatabase = QApplication::$Database[1];
	   		$objDbResult = $objDatabase->Query($strQuery);
		    
		    //var_dump($objDbResult);
	   		$arr = array();
			while ($mixRow = $objDbResult->FetchArray()) {
				$row = array($mixRow['Name'],$mixRow['Path'], $mixRow['FBId'], $mixRow['Tracks']);
		        array_push($arr,$row);
		        //array_push($array, $mixRow['Name'], $mixRow['Path'], $mixRow['FBId'], $mixRow['Tracks']);
   			 }
		    return $arr;
	}




	public static function JoinByRoomID($userId,$roomId,$totalTracks,$hours = 1 )
	{
	  		

	  	$resultInfo = parent::LoadArrayByHostID($roomId); 
	  	$arrayData = array();
		if($resultInfo){
			foreach ($resultInfo as $var => $value) {
					$unlTracks = $value->UnlockedTracks;						
			}
			if(intval($totalTracks)<intval($unlTracks)){
				return "unlocked ".$unlTracks." of ".$totalTracks;
			}else{
				$unlTracks = $unlTracks+1 ;
				$strQuery="
						INSERT INTO tracks (roomId, userId,trackNumber) 
		   				SELECT ".$roomId.",".$userId.",".$unlTracks." FROM DUAL WHERE NOT EXISTS(SELECT userId FROM tracks WHERE userId = ".$userId.")
		   				";
				$objDatabase = QApplication::$Database[1];
	   			$objDbResult = $objDatabase->Query($strQuery);
	   			if($objDbResult){
		   				$strQuery2 = "
						SELECT U.name AS Name, U.avatar AS Path, T.userId AS FBId, T.trackNumber AS Tracks
						FROM rooms
						JOIN tracks T ON ( rooms.hostID = T.roomId ) 
						JOIN users U ON ( U.fbId = T.userId ) 
						WHERE rooms.createdTime >= NOW( ) - INTERVAL ".$hours." HOUR 
						AND rooms.hostID = ".$roomId."
						ORDER BY T.trackNumber ASC ";
					$objDatabase2 = QApplication::$Database[1];
			   		$objDbResult2 = $objDatabase2->Query($strQuery2);
				    //var_dump($objDbResult);
			   		$arr2 = array();
					while ($mixRow = $objDbResult->FetchArray()) {
						$row = array($mixRow['Name'],$mixRow['Path'], $mixRow['FBId'], $mixRow['Tracks']);
				        array_push($arr2,$row);
				        //array_push($array, $mixRow['Name'], $mixRow['Path'], $mixRow['FBId'], $mixRow['Tracks']);
	   				 }
			    	return "arr".$arr2;
	   			}else{
	   				return "no result after adding track";

	   			}
			}

		}else{
			return "no room with taht ID";
		}	
	    	
	}

	public static function GetRoom($roomId){


/*		
		$strQuery = "
		SELECT rooms.id, rooms.hostID, rooms.urk, rooms.unlockedTracks, users.fbId 
		FROM rooms
		INNER JOIN users
		ON users.fbId=rooms.hostID
		";




		$strQuery = "
			SELECT *
			FROM rooms
			WHERE createdTime >= NOW() - INTERVAL ".$hours." HOUR
			AND hostID = ".$userId."
			ORDER BY createdTime DESC
			LIMIT 1";

		 $objDatabase = QApplication::$Database[1];
		 
		 // Perform the Query
   		 $objDbResult = $objDatabase->Query($strQuery);
    	// Iterate through the Database Result using ->FetchRow() or ->FetchArray(), as you would if
    	// you used the a database connector, directly.
	    $mixRow = $objDbResult->FetchArray();

	   


//if there is room hosted by user return its content or look for tracks with userID
	    if($mixRow == null ){
	    	$strQuery = "
			SELECT *
			FROM tracks
			WHERE userId = ".$userId;
			 $objDatabase = QApplication::$Database[1];

	   		 // Perform the Query
	   		 $objDbResult = $objDatabase->Query($strQuery);

	 // Iterate through the Database Result using ->FetchRow() or ->FetchArray(), as you would if
	 // you used the a database connector, directly.
		    $mixRow = $objDbResult->FetchArray();
	//if there is no tracks with userID	
	// create user room hosted by him    
		    
		    
	    }else{
	    	return $mixRow;	
	    }
*/
	   	 
	}

	public static function GetRooms()
	{
			 $objPersonArray = RoomsGen::QueryArray(
        			QQ::All(),
       				QQ::Clause(
            		QQ::OrderBy(QQN::Rooms()->HostID, QQN::Rooms()->Id)
        			)
    		);
		return $objPersonArray;	 
	}

        
    }
?>
