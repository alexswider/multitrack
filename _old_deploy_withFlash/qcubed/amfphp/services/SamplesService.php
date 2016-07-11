<?php
require_once '../../qcubed.inc.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class SamplesService extends Rooms{
    
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

	public static function CreateRoom($userId,$tracksUnlocked)/*{{{*/
	{
			$room = new RoomsGen();
			$room->HostID 			= $userId;//FBID
			$room->UnlockedTracks 	= $tracksUnlocked;
			$room->Urk 				= "shortURL";
//$sample->SubmitDate = strtotime('22-09-2008');;        
            if (is_numeric($room->Save(true))) {
                return $room->Id;
			} else {
				return false;	
			}
	}


	public static function GetRoomsInLast($userId,$hours)
	/*
	{{{
	*/
	{
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

		return $mixRow;	
			 
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
