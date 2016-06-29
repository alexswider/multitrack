<?php

require_once('../admin/qcubed_nopass.inc.php');

    $objDatabase = Listeners::GetDatabase();
    $objDatabase->TransactionBegin();

    // Find the last/highest `order` value
	$objResult = $objDatabase->Query("SELECT `order`
									  FROM `listeners` 
									  ORDER by `order` DESC LIMIT 1 FOR UPDATE");
    $resultInfo = $objResult->FetchArray();
    $highestOrder = 0;
    if ($resultInfo) {    	        						                
	    foreach ($resultInfo as $var => $value) {
		    $arrayData[$var] = $value;
    	}
        $highestOrder = $arrayData['order'];
    }

	// This selects the next user allowed to play the song
	$objResult = $objDatabase->Query("SELECT * FROM 
									      `listeners` 
									  ORDER by `order` ASC LIMIT 1");
		    
    $resultInfo = $objResult->FetchArray();        
	$arrayData = array();
	
	foreach ($resultInfo as $var => $value) {
		if (is_object($value)) {
			$arrayData[$var] = $value->Id;						
		} else {
			$arrayData[$var] = $value;
		}
	}		
	
	if ($arrayData['start_time']<(time()+(60*60*2))) {
	    $listenerObj = Listeners::LoadById($arrayData['id']);
	    $listenerObj->StartTime = NULL;
	    // What do we do with order? Or maybe we delete user altogether?
	    // $listenerObj->Order = $highestOrder + 1;
	    $listenerObj->Save();
	}
	
    // Reorder users or delete user with order 1
	// Load new user with order = 1 (previously 2), set his start_time
	
	
	$objDatabase->TransactionCommit(); 
	


?>