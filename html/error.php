<?php
require_once '../includes/db_config.php';
$error = $_GET['err'];
//log the error to some log file with certain information

echo "Something went wrong! Try closing the website and relogging in again. If that doesn't work please submit a bug report by contacting your website administrator. Thank you for your help.";
/*echo  '<br>' . 
constant("HOST") . '<br> ' . 
constant("SESSION_USER")  . '<br> ' . 
constant("SESSION_PASSWORD") . '<br> ' . 
constant("SESSION_DATABASE") . '<br> ' . 
constant("LOGIN_USER") . '<br> ' . 
constant("LOGIN_PASSWORD") . '<br> ' . 
constant("LOGIN_DATABASE") . '<br> ' . 
constant("CAN_REGISTER")  . '<br> ' . 
constant("DEFAULT_ROLE") . '<br> ' . 
constant("SECURE"); */