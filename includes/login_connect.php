<?php
require_once 'db_config.php'; // loads credentials

try {
	$logDB = new PDO('mysql:host='.constant("HOST").';dbname='.constant("LOGIN_DATABASE").';charset=utf8', constant("LOGIN_USER"), constant("LOGIN_PASSWORD"));
	$logDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // places PDO into exception mode for error handling
	$logDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // disables prepare() emulation
	//print_r ($logDB);
}
catch(PDOException $ex) {
	//echo "something went wrong." . HOST . LOGIN_DATABASE . LOGIN_USER . LOGIN_PASSWORD;
	//header("Location: ".$URL_ROOT."/error.php?err=LOG_DB_STARTUP_FAIL");
	print_r ($logDB);
}