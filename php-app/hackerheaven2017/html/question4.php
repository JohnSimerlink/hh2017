<?php
require_once '../includes/functions.php';


if (isset($_POST['zipcode'])){

	$zipcode= $_POST['zipcode']; 

	$mysqli = new mysqli(constant("DATA_HOST"), constant("DATA_USER"), constant("DATA_PASSWORD"), constant("DATA_DATABASE"));
	$sql = "SELECT username, zipcode, is_admin FROM users WHERE zipcode = " . $zipcode;

	if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	echo "<ul>";
	do {
	    if ($res = $mysqli->store_result()) {
	       
		while($row = $res->fetch_assoc()){
			foreach ($row as $key => $value){
				echo "<li>$key: $value;</li> ";
			}
			echo "<br>";
		}
		 $res->free();
	    }
	} while ($mysqli->more_results() && $mysqli->next_result());
	echo "</ul>";
}
