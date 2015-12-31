<?php
include_once 'functions.php';
logout();
//print_r($_SESSION);
header('Location: '. $_SERVER['HTTP_REFERER']); //redirect the user to the page the user logged out from. this will be the page they were at before the logout button redirected them to logout.php
//TODO: do something better^^. because some users have http_referer disabled in their browser. and some old browsers dont support it - http://stackoverflow.com/questions/4004416/to-obtain-the-previous-pages-url-in-php
