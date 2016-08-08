<?php
include_once 'login_connect.php';
include_once 'functions.php';
 
session_start() or die('some session error'); 
//echo $_POST['email'], $_POST['p'];
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
   // echo "The client side hashed password is $password<br>";
 
    if (login($email, $password, $logDB) == true) {
        // Login success 
       // print_r($_SESSION);

      //echo $_SERVER['HTTP_REFERER'];
      header('Location: '. removeGetRequests($_SERVER['HTTP_REFERER']) ); //redirect to the page where ever they logged in from.
    } else {
        // Login failed 
       header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=401&description="Bad Login"'); // Bad login
       // echo "login failed";
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=400&description="Bad Request - The correct POST variables were not sent to this page"'); // Bad request error code
}

//header('Location: ' . )




function removeGetRequests($url){
  $endPosition = strpos($url, '?');
  if ($endPosition === false){
    return $url;
  }
  else{
    return substr($url, 0, $endPosition);
  }
}