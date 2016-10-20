<?php
require_once 'environment_config.php';
// Login/session database details. Can be modified as necessary.
// NOTE: CANNOT BE USED FOR PRODUCTION IN CURRENT CONFIGURATION. NOT SECURE

//TODO: have different users and databases, for different secure functions. e.g. a secure login database.

switch($db_environment){
	case "localhost":
		define("DATA_HOST", "localhost");
		define("DATA_USER", "webuser2");
		define("DATA_PASSWORD", "TurkeyDayApproachesYum");
		define("DATA_DATABASE", "hhdata"); 
		define("LOGIN_HOST", "");
		define("LOGIN_USER", "hh_login");
		define("LOGIN_PASSWORD", "6MdV5YxT88XahUMU");
		define("LOGIN_DATABASE", "hh_login");
		
		define("CAN_REGISTER", "any");
		define("DEFAULT_ROLE", "member");
		define("SECURE", "true");
		break;	
}

/*
login info for 000webhost.com mysql hosting
user: johnsimerlinkdev@gmail.com
pass: hh_logintecholympics


database: a3504620_dansime
mysql user: a3504620_dansime
mysql pass:h h_logintecholympics
mysql host: mysql6.000webhost.com

mysql -h mysql6.000webhost.com -u a3504620_dansime -p
*/
