<?php
class FlashSecurity
{
	public function __construct() 
	{
  		require_once("RC4.php");
	}
	public function encodeObject($obj, $key)
  	{
		$encodedGuid = RC4::rc4Encrypt($key, json_encode($obj));
  		return bin2hex($encodedGuid);
  	}
  	
  	public function encodeItem($item, $key)
  	{
		$encodedItem = RC4::rc4Encrypt($key, $item);
  		return bin2hex($encodedItem);
  	}
  	
  	public function decodeObject($secretString, $key)
  	{
  		$secretString2Bin = pack("H*" , $secretString);
		$decodedObject = RC4::rc4Decrypt($key, $secretString2Bin);
		$jsonDecoded = json_decode($decodedObject);
  		return $jsonDecoded;
  	}
}
?>