<?php
session_start();
//Note header.php must always be included by a file that is located in a subdirectory of public_html(e.g. it must be included by a file that is located in the home or app directory)
require_once '../../includes/functions.php';
require_once 'register.php'; //included only to get the register_error_msg at the start. also because of the registration form submission.


/* = = = = = ============================= Construct the Header ============================ = = = = = */ 
  /* - - - - Logic to determine what is displayed in the menu based on the user's login status - - - - */
  $register_error_msg="";
  if (login_check($logDB) == true) {
      $logged = 'in';
  } else {
      $logged = 'out';
  }
  //echo "You are logged " . $logged;

  /* - - - - ---------------------------------------------------------------------------- - - - - */


  /* - - - - Build the header, inserting in the above constructing variables storing html - - - - */
$headerOut = <<<html
<!DOCTYPE html>
<!-- saved from url=(0052)http://getbootstrap.com/2.3.2/examples/carousel.html -->
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Hacker Heaven 2015</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href ="matrix_style.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="$URL_ROOT/css/bootstrap/css/bootstrap-2.3.2.min.css"/>
    <link rel="stylesheet" type="text/css" href="$URL_ROOT/css/bootstrap/css/bootstrap-responsive-2.3.2.min.css"/>

  
<!-- ------------------------------- SCRIPTS -------------------------------- -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <![endif]-->

    <!-- JQuery and CSS Bootstrap scripts -->
    <script src=$URL_ROOT/js/jquery-2.1.3.min.js></script>
    <script src=$URL_ROOT/js/bootstrap.min.js></script>

    <!-- Login and Registration Processing Scripts -->
    <script src=$URL_ROOT/js/sha512.js></script> 
    <script src=$URL_ROOT/js/forms.js></script> 
    


  <!--JQUERY FORM Plugin for AJAX FORMS-->
  <script src=$URL_ROOT/js/jquery.form.js></script>
  <!--Plug in for nicely converting JSON to an HTML table -->
  <script src=$URL_ROOT/js/jsonToTable.js></script>
  <!--Plugin for neat confirm boxes -->
  <script src=$URL_ROOT/js/bootbox.js></script>

<!--//END ------------------------------- SCRIPTS -------------------------------- -->

  </head>

html;
  /* - - - - ---------------------------------------------------------------------------- - - - - */
/* = = = = = ============================= ==================== ============================ = = = = = */ 


/* = = = = = ============================== Display the Header ============================= = = = = = */
echo $headerOut;