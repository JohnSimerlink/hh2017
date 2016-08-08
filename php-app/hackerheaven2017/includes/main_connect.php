<?php
require_once 'db_config.php'; // loads credentials
global $dbh;
	
try {
	$dbh = new PDO('mysql:host='.constant("DATA_HOST").';dbname='.constant("DATA_DATABASE").';charset=utf8', constant("DATA_USER"), constant("DATA_PASSWORD"));
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // places PDO into exception mode for error handling
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // disables prepare() emulation
	//print_r($dbh);
}

catch(PDOException $ex) {
//	echo "connection to database didn't work";
	header("Location: ".$URL_ROOT."/error.php?err=DB_STARTUP_FAIL");
}