<?php
session_start();
require_once '../includes/functions.php';
require_once 'questions.php';
$answers = array('iloveyou', 'itcareerscamp', 'cashmeoutside', 'unitedairlines', 'answer4usesafunction', 'iswise');

$questionNumber = substr($_POST['qn'], -1);
$password = $_POST['password'];


switch ($questionNumber) {
	case 'a':
		$questionNumber = 0;
		break;
	case 'r':
		$questionNumber = 1;
		break;
	case 's':
		$questionNumber = 2;
		break;
	case 't':
		$questionNumber = 3;
		break;
	case 'd':
		$questionNumber = 4;
		break;
	case 'h':
		$questionNumber = 5;
		break;
	default:
		$questionNumber = 0;
		break;
}

//green red yellow white blue magenta invisible
$color = array('green', 'red', 'yellow', 'white', 'blue', 'magenta', 'invisible');

//echo "quesion number is $questionNumber. answer = " . $answers[$questionNumber] . ",  Users answer was: $password.";
function answer4($username, $password, $dbh){
	$userId = 1;
	$sql = "SELECT password, is_admin FROM users WHERE username = '$username'";//still allow a certain level of sql injection
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $count = $stmt->rowCount();
    if($count > 0){
    	$row = $stmt->fetch();
    	if ($row['password'] == $password){
    		if($row['is_admin'] == 'true'){ //example pass is imthemap
    			return true;
    		}
    		else{
    			echo "this user is not an admin";
    			return false;
    		}
    	}
    	else {
    		echo "incorrect password";
    		return false;
    	}
    }
    else {
    	echo "User does not exist";
    	return false;
    }
 
}

if (isset($_POST['password'])){

	if($questionNumber == 4){
		$correct= answer4($_POST['username'], $_POST['password'], $dbh);
		if ($correct == true){
			$nextQuestionNumber = $questionNumber + 1;
			//$_SESSION['questionNumber'] = $_SESSION['questionNumber']+1;
			$response = 'HTML' . $questions[$questionNumber + 1] . "<script>setColor('" . $color[$nextQuestionNumber] . "');</script>";;
		}
		else $response = 'incorrect';
	}
	else{ 
		if($_POST['password'] == $answers[$questionNumber]){
			$nextQuestionNumber = $questionNumber + 1;
			$response = "HTML". $questions[$nextQuestionNumber] . "<script>setColor('" . $color[$nextQuestionNumber] . "');</script>";
			//echo "question number is $questionNumber. answer = " . $answers[$questionNumber] . ",  Users answer was: $password.";
		}
		else {
			$response = "incorrect answer of " . $_POST['password'] . " for question " . $questionNumber . "whose answer acutally is " . $answers[$questionNumber];// Your answer was . ' . $_POST['password'] . " the correct answer was " . $answers[$_SESSION['questionNumber']] . "your question number is " . $_SESSION['questionNumber'];
		}
	}
	echo $response;

}
