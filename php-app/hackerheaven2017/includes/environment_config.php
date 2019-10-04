<?php
//ATTENTION DEVELOPER: Choose how your environment is set up here, by changing the value of the $environment variable, and adding a case statement as necessary.

$local_environment = "PRODUCTION_AWS"; //IF you are on the production server, set this to "PRODUCTION_AWS".\
$db_environment = "localhost"; //IF you are on the production server set this to "PRODUCTION_AWS_RDS";
$URL_ROOT =''; // URL_ROOT affects the location that CSS and img files pull from, as well as where php redirects go to
$HTML_FOLDER =''; //essentially this is the last folder in URL_ROOT. This is used when determining the location to save hte images in, basfed on which environment we are in.
$GLOBALS['URL_ROOT'] ='';
$GLOBALS['HTML_FOLDER'] ='';



switch($local_environment){
	case "DEV_JOHN_LINUX_LAMP":
		$URL_ROOT = '/xampp/hacker_heaven_2015/html'; $GLOBALS['URL_ROOT'] ='/xampp/hacker_heaven_2015/html';
		$HTML_FOLDER = 'public_html'; $GLOBALS['HTML_FOLDER'] ='public_html';
		break;

	case "PRODUCTION_AWS":
		$URL_ROOT = '';	$GLOBALS['URL_ROOT'] ='';
		$HTML_FOLDER = 'html'; $GLOBALS['HTML_FOLDER'] ='html';
		break;
}
