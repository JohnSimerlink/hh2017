<?php
require_once 'environment_config.php';
switch($db_environment) {
	case "localhost":
		define("DATA_HOST", "localhost");
		define("DATA_USER", "webuser2");
		define("DATA_PASSWORD", "TurkeyDayApproachesYum");
		define("DATA_DATABASE", "hhdata"); 
		break;	
}

