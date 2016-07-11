<?php
require_once '../../qcubed.inc.php';

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class UsersService extends Users{
    
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


	public static function CheckUser($userId)/*{{{*/
	{
			$objPersonArray = UsersGen::QueryArray(
        			QQ::Like(QQN::Users()->FbId, $userId),
        			QQ::Clause(
		            QQ::LimitInfo(1)
    		    )
    		);
		return $objPersonArray;
		
		
			 
	}

	public static function CreateUser($userId,$name,$IP = "192.168.1.1",$avatar = "123")/*{{{*/
	{
			$user = new UsersGen();
			$user->FbId				= $userId;
			$user->Ip 				= $IP;
			$user->Name 			= $name;
			$user->Avatar			= $avatar;
			
	//$sample->SubmitDate = strtotime('22-09-2008');;        
            if (is_numeric($user->Save(true))) {
                return $user->Id;
			} else {
				return false;	
			}
	}

        
    }
?>
