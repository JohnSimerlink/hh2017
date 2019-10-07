<?php
require_once '../includes/functions.php';
if (isset($_POST['zipcode'])){
	echo "stuff";
	echo phpversion();
	// echo phpinfo();
	try {
		$zipcode = $_POST['zipcode']; 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		// throw new Exception('test123');
		// echo constant("DATA_HOST");
		// echo constant("DATA_USER");
		// echo constant("DATA_PASSWORD");
		// echo constant("DATA_DATABASE");
		$mysqli = new mysqli(constant("DATA_HOST"), constant("DATA_USER"), constant("DATA_PASSWORD"), constant("DATA_DATABASE"));
		// $connect = mysqli_connect(constant("DATA_HOST"), constant("DATA_USER"), constant("DATA_PASSWORD"), constant("DATA_DATABASE"));
		echo "++++";
		// echo $connect;
		echo "++++";
		// echo "5123";
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
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
