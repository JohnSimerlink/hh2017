<?php
require_once 'environment_config.php';
// Login/session database details. Can be modified as necessary.
// NOTE: CANNOT BE USED FOR PRODUCTION IN CURRENT CONFIGURATION. NOT SECURE

//TODO: have different users and databases, for different secure functions. e.g. a secure login database.

switch($db_environment){
	case "localhost":
		define("HOST", "localhost");
		define("SESSION_USER", "hh_data");
		define("SESSION_PASSWORD", "SBuzhYPT4J6VNsxL");
		define("SESSION_DATABASE", "hh_data"); 
		define("LOGIN_USER", "hh_StkafynS");
		define("LOGIN_PASSWORD", "6MdV5YxT88XahUMU");
		define("LOGIN_DATABASE", "hh_login");
		define("CAN_REGISTER", "any");
		define("DEFAULT_ROLE", "member");
		define("SECURE", "true");
		break;	
	case "PRODUCTION_AWS_RDS":
		define("HOST", "test.c2axenk77mct.us-east-1.rds.amazonaws.com");
		define("SESSION_USER", "quisper_dat_user");
		define("SESSION_PASSWORD", "j5JeGvTHUJZh5AVZ");
		define("SESSION_DATABASE", "quisper2_data"); 
		define("LOGIN_USER", "quisper_SAWtWbXq");
		define("LOGIN_PASSWORD", "QhVVKQA6arMHrpuq");
		define("LOGIN_DATABASE", "quisper2_cms_login");
		define("CAN_REGISTER", "any");
		define("DEFAULT_ROLE", "member");
		define("SECURE", "true");
		break;	

}
