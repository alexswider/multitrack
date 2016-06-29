<?php
require_once '../../qcubed.inc.php';




/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Test extends Rooms{
    
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

	public static function JoinByRoomID2($userId,$roomId,$totalTracks,$hours = 1 )
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
				$strQuery="
						INSERT INTO tracks (userId) 
		   				SELECT '123' FROM DUAL WHERE NOT EXISTS(SELECT userId FROM tracks WHERE userId = '123')
		   				";
				$objDatabase = QApplication::$Database[1];
		   		$objDbResult = $objDatabase->Query($strQuery);
	   			
			}

		}else{
			return "no room with taht ID";
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

	public static function GetTrackByIDPHP($roomId,$hours = 4){
		

	}


	public static function GetTracksByRoomID($roomId,$hours=4)
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

		    return $objDbResult;
	}
	


	public static function JoinByRoomID($user,$roomId,$totalTracks)
	{
	  	
	    	$strQuery = "
				SELECT users.name as Name, users.avatar as Path, tracks.userId as FBId, tracks.trackNumber as Tracks
				FROM rooms, tracks, users
				WHERE  rooms.hostID = tracks.roomId 
				AND rooms.hostID = ".$roomId."
				AND users.fbId = tracks.userId
				AND rooms.createdTime >= NOW() - INTERVAL ".$hours." HOUR
				ORDER BY tracks.trackNumber ASC";
			$objDatabase = QApplication::$Database[1];
	   		$objDbResult = $objDatabase->Query($strQuery);
		    $mixRow = $objDbResult->FetchArray();

		    $arrayLength = count($mixRow);
		    
		    if($arrayLength >= $totalTracks){
		    	$mixRow[0] = "false:TracksLocked:".$arrayLength;

		    }else{


		    }
		    return $mixRow;
	}

	public static function GetRoom($roomId){


	   	 
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


$a = new Test();
$a->JoinByRoomID2(123,123,23,231)

?>
