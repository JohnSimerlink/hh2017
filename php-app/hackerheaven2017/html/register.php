<?php
//echo getcwd();
include_once /*'realpath(*/'../includes/register.inc.php';
include_once '../includes/functions.php';
?>
        <?php
        //header('Location: '.$_SERVER['REQUEST_URI']);
        if (!empty($register_error_msg)) {
            echo $register_error_msg;
        }//not sure if that ever gets called?
        ?>
