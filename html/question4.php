<?php
require_once '../includes/functions.php';
//echo "test";


if (isset($_POST['zipcode'])){

	$zipcode= $_POST['zipcode']; 
//	echo $zipcode;

	$mysqli = new mysqli(constant("HOST"), constant("SESSION_USER"), constant("SESSION_PASSWORD"), constant("SESSION_DATABASE"));
	//$sql = "SELECT username, LastName, FirstName FROM users WHERE zipcode = " . $zipcode;
	$sql = "SELECT username, LastName, FirstName, zipcode FROM users WHERE zipcode = " . $zipcode;
//	echo $sql; 
//	$results = $mysqli->query($sql);

	if (!$mysqli->multi_query($sql)) {
    echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
//	echo "script made it past first mysqli multi query";
	do {
	    if ($res = $mysqli->store_result()) {
	       // var_dump($res->fetch_assoc());
	       
		while($row = $res->fetch_assoc()){
			var_dump($row);
		}
		 $res->free();
	    }
	} while ($mysqli->more_results() && $mysqli->next_result());
	//while($row = $results -> fetch_assoc()){
	//	print_r ($row);
	//}

   /* $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    print_r($result);
    echo $sql;*/
/*
    $arr = $result;
    echo "<table>";
	foreach($arr as $k=>$v)
		foreach($v as $k2=>$v2)
	    	echo "<tr><td>$k2</td><td>$v2</td></tr>";
	echo "</table>"; */
/*
    $output = '<ul class="collection with-header">';
$ouput.= '<li class="collection-header"><h4>First Names</h4></li>';
    for ($row = $stmt->fetch()){

        
        <li class="collection-item"><div><i class="secondary-content mdi-content-send"></i></div></li>
        <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
        <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
        <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
      </ul>
  }
*/
}
