<?php
require_once '../../qcubed.inc.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TracksService extends Tracks{
    
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


	public static function CheckTrack()/*{{{*/
	{
			$objPersonArray = TracksGen::QueryArray(
        			QQ::Like(QQN::Users()->FbId, $userId),
        			QQ::Clause(
		            QQ::LimitInfo(1)
    		    )
    		);
		return $objPersonArray;



	}

	public static function CreateTrack($userId,$roomId,$trackNumber)
	{
			$track = new TracksGen();
			$track->RoomId = $roomId;
			$track->UserId = $userId;
			$track->TrackNumber = $trackNumber;
			
	//$sample->SubmitDate = strtotime('22-09-2008');;        
            if (is_numeric($track->Save(true))) {
                return $track->Id;
			} else {
				return false;	
			}
	}

        
    }
?>
