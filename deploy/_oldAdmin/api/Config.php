<?php
//ini_set("display_errors",true);
//error_reporting(E_ALL ^ E_NOTICE);
define("_RUNNING_ONLINE", false);
if(_RUNNING_ONLINE)
{
	define("DB_HOST", "localhost");
	define("DB_USER", "vds");
	define("DB_PASSWORD", "f917e6ce1b");
	define("DB_NAME", "kitchen");
} else
{
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_NAME", "multitrack");
	define("DB_PASSWORD", "root");
}
define("ABS_PATH",			dirname(__FILE__)."/");

?>