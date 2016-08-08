<?php
//Database stuff

//Table of Contents
/*
sec_session_start()
login($email, $password, $logDB)
checkbrute($user_id, $logDB)
login_check($logDB)
logout()
esc_url($url)
changeEnrollment($dbh, $userId, $quizId, $type, $action)
createQuiz($dbh, $quizName, $quizDescription, $creatorId)
*/


//connect to the current main db
require_once 'main_connect.php'; // connects to the main database, but does not initialize any session variables yet.
require_once 'login_connect.php'; // connects to login database.

/*  ___________________
   /                   \
  |        BEGIN        |
  |   LOGIN FUNCTIONS   |
   \___________________/
*/
//TODO: make it so that the sec_session_start()function works. Currently it makes it so that the session variable is cleared each time you go to a new page . . .
//currently we are just using the insecure session_start() function
function sec_session_start() { // Separate TODO: Replace with more secure system
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function login($email, $password, $logDB) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $logDB->prepare("SELECT id, username, password, salt, is_approved, is_admin, is_super_admin 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bindParam(1, $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.

        /* Bind columns */
        $stmt->bindColumn(1, $user_id);
        $stmt->bindColumn(2, $username);
        $stmt->bindColumn(3, $db_password);
        $stmt->bindColumn(4, $salt);
        $stmt->bindColumn(5, $is_approved);
        $stmt->bindColumn(6, $is_admin);
        $stmt->bindColumn(7, $is_super_admin);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
   //     print_r ($result);
  //      echo "the number of users with that email address is " . count($result) / 4;
        $now = time();
   //     echo "time now is $now and userid is $user_id";
        //echo $result;

 
        // hash the password with the unique salt.
       $password = hash('sha512', $password . $salt);
        if (count($result) == 1 *7) {// if there was one result - a.k.a one user with that email address. Notice times 7 because there are 7 columns
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $logDB) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
            //    echo "the result of checkbrute was true";
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {//notice both of these are hashed
                    // Password is correct!
                    session_start();
                    //start the session. 
                   // sec_session_start();
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful.

                    $_SESSION['is_approved'] = $is_approved;
                    $_SESSION['is_admin'] = $is_admin;
                    $_SESSION['is_super_admin'] = $is_super_admin;
                    return true;
                } else {
                    // Password is not correct
                 //   echo "the db password was $db_password and the password was $password";
                    // We record this attempt in the database
                    $now = time();
                    $stmt = $logDB->prepare("INSERT INTO login_attempts(user_id, time)
                                    VALUES (?, ?)");
                    $stmt->bindParam(1, $user_id);
                    $stmt->bindParam(2, $now);
                    $stmt->execute();
                    return false;
                }
            }
        } else {
            // No user exists.
            echo "no user exists";
            return false;
        }
    }
}

function checkbrute($user_id, $logDB) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    $stmt = $logDB->prepare("SELECT time 
                             FROM login_attempts
                             WHERE user_id = ? 
                            AND time > ?");
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $valid_attempts);
 
        // Execute the prepared query. 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // If there have been more than 5 failed logins 
        if (count($result) > 5 * 1) { // times 1 because we are only selecting one column
            return true;
        } else {
            return false;
        }
}

function login_check($logDB) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'], $_SESSION['is_approved'], $_SESSION['is_admin'], $_SESSION['is_super_admin'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        $is_approved = $_SESSION['is_approved'];
        $is_admin = $_SESSION['is_admin'];
        $is_super_admin = $_SESSION['is_super_admin'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $logDB->prepare("SELECT password 
                                      FROM members
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bindParam(1, $user_id);
            $stmt->execute();   // Execute the prepared query.
 
            if ($stmt->rowCount() == 1) {//TODO: stmt->rowCount() isn't portable for SELECT statements beyond MySQL. would have to count rows differently
                // If the user exists get variables from result.
                $stmt->bindColumn(1, $password);
                $result = $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function getUsername($logDB, $userId){
    $stmt = $logDB->prepare("SELECT username from members WHERE id = :user_id");
    $stmt->bindParam(1, $userId);

    // Execute the prepared query. 
    $stmt->execute();
    $row = $stmt->fetch();

    $username = $row['username'];
    return $username;
}

/*  ___________________
   /                   \
  |         END         |
  |   LOGIN FUNCTIONS   |
   \___________________/
*/

function logout(){
	session_start();
	 
	// Unset all session values 
	$_SESSION = array();
	 
	// get session parameters 
	$params = session_get_cookie_params();
	 
	// Delete the actual cookie. 
	setcookie(session_name(),
	        '', time() - 42000, 
	        $params["path"], 
	        $params["domain"], 
	        $params["secure"], 
	        $params["httponly"]);
	 
	// Destroy session 
	session_destroy();
}


function esc_url($url) { // cleans up relative url calls to avoid XSS attacks (adapted from WordPress fn)
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}


function createQuiz($dbh, $quizName, $quizDescription, $quizTheme, $quizCategoryId, $biteSize, $creatorId){
    $sql = "INSERT INTO quizzes (title, description, theme, category_id, bite_size, creator_id, is_approved) VALUES (:quizName, :quizDescription, :quizTheme, :quizCategoryId, :biteSize, :creatorId, 'false')";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':quizName' => $quizName, ':quizDescription' => $quizDescription, 'quizTheme' => $quizTheme, ':quizCategoryId' => $quizCategoryId, ':creatorId' => $creatorId, ':biteSize' => $biteSize));
	
	return $dbh->lastInsertId('id');
}

function createQuestion($dbh, $quizId, $questionTitle, $questionType, $creatorId){
    if(isValid('questionType', $questionType)){
        $sql = "INSERT INTO questions (quiz_id, title, type, creator_id) VALUES (:quizId, :questionTitle, :questionType, :creatorId)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':quizId' => $quizId, ':questionTitle' => $questionTitle, ':questionType' => $questionType, ':creatorId' => $creatorId));
        
        return $dbh->lastInsertId('id');
    }
    else return null;
}

function createChoice($dbh, $questionId, $choiceTitle, $creatorId){
    $sql = "INSERT INTO choices (question_id, title, creator_id) VALUES (:questionId, :choiceTitle, :creatorId)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':questionId' => $questionId, ':choiceTitle' => $choiceTitle, ':creatorId' => $creatorId));
    
    return $dbh->lastInsertId('id');
}

function deleteImage($directory, $listingId, $cropped, $imgType, $extension){

    if(isValid('directory', $directory) && isValid('imgType', $imgType) && is_int($listingId))
    {    
        if($cropped == 'cropped'){
            $cropped = '';
        }
        else $cropped .= '/';
        $fileLocation = dirname(dirname(__FILE__)) . '/'. $GLOBALS['HTML_FOLDER'] . '/app_img/' . htmlentities($directory, ENT_QUOTES) . '/' . intval($listingId) . '/'. $cropped . $imgType . $extension;

        if(unlink($fileLocation))
            echo "File Deleted.";
        else echo "File not deleted ";
    }
    else "Deletion not attempted. Invalid input";
}

function storeOriginalExtension($dbh, $notCroppedExt, $directory, $listingId){

    /*if(is_int($listingId)){*/

        $table = '';
        $column = '';
        if($directory == 'quizzes'){
            $table = 'quizzes';
            $column = 'quiz_img_link_notcropped_ext';
        } else if($directory == 'topics'){
            $table = 'quizzes';
            $column = 'topics_img_link_notcropped_ext';  
        } else if($directory == 'choices'){
            $table = 'choices';
            $column = 'img_link_notcropped_ext';
        }
        else exit('invalid directory for storing the original extension');

        $sql = "UPDATE $table SET $column = :notCroppedExt WHERE id = :listingId";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':notCroppedExt' => $notCroppedExt, ':listingId' => intval($listingId)));
    /*}*/
    //else "Extension not stored. invalid listing id";
}

function getOriginalExtension($dbh, $directory, $listingId){
    if($directory == 'quizzes'){
        $table = 'quizzes';
        $column = 'quiz_img_link_notcropped_ext';
    } else if($directory == 'topics'){
        $table = 'quizzes';
        $column = 'topics_img_link_notcropped_ext';  
    } else if($directory == 'choices'){
        $table = 'choices';
        $column = 'img_link_notcropped_ext';
    }
    else exit('invalid directory for storing the original extension');

    $sql = "SELECT $column FROM $table WHERE id = :listingId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':listingId' => intval($listingId)));

    $row = $stmt->fetch();
    $originalExt = $row[$column];
    return $originalExt;
}

function isValid($variable, $value){
    if ($variable == 'directory'){
        return ($value == 'quizzes' || $value == 'topics' || $value == 'choices');
    }
    elseif ($variable == 'imgType'){
        return ($value == 'quiz_img' || $value == 'topics_img' || $value == 'choice_img');
    }
    elseif ($variable == 'questionType'){
        return ($value == 'MultipleChoice2' || $value == 'MultipleChoice3' || $value == 'HumpDumpMarry' || $value == 'HaveYouEver');
    }
}

function getOwnerId($dbh, $directory, $listingId){

    if (isValid('directory', $directory) || $directory == 'questions'){
        if($directory == 'quizzes' || $directory == 'topics'){
            $table = 'quizzes';
        }
        elseif($directory == 'questions'){
            $table = "questions";
        } 
        elseif($directory == 'choices'){
            $table = 'choices';
        }
        $sql = "SELECT creator_id FROM $table WHERE id = :listingId";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':listingId' => intval($listingId)));

        $row = $stmt->fetch();
        $ownerId = $row['creator_id'];

        return $ownerId;
    }
    else return null;
}

function getQuizId($dbh, $listingType, $listingId){
    if (isValid('directory', $listingType) || $listingType == 'questions'){
        if ($listingType == 'choices'){
            $sql = "SELECT question_id FROM choices WHERE id = :listingId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':listingId' => intval($listingId)));

            $row = $stmt->fetch();
            $questionId= $row['question_id'];

            return getQuizId($dbh, 'questions', $questionId);
        }
        else if ($listingType == 'questions'){
            $sql = "SELECT quiz_id FROM questions WHERE id = :listingId";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':listingId' => intval($listingId)));

            $row = $stmt->fetch();
            $quizId= $row['quiz_id'];

            return $quizId;
        }
        else if ($listingType == 'quizzes'){
            return $listingId; //meaning listingId is quiz ID
        }
        else return null;
    }
}

function quizIsApproved($dbh, $quizId){
    $sql = "SELECT is_approved from quizzes where id = :quizId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':quizId' => $quizId));

    $row = $stmt->fetch();
    $isApproved = $row['is_approved'];

    return ($isApproved == 'true');

}

function userCanViewQuiz($dbh, $logDB, $listingType, $listingId){

    $quizId = getQuizId($dbh, $listingType, $listingId);

    return ( //IF
           /* 1 The user is logged in + approved */ 
                (login_check($logDB) == true && $_SESSION['is_approved'] == 'true')
        && (/*2 the user owns the quiz or is an admin */ 
                $_SESSION['user_id'] == getOwnerId($dbh, 'quizzes', $quizId) || userIsAdmin()
            )
       );

}

function userCanEditQuiz($dbh, $logDB, $listingType, $listingId){

    $quizId = getQuizId($dbh, $listingType, $listingId); 

    
    return ( //IF
             /*1 the user is allowed to view the quiz */ userCanViewQuiz($dbh, $logDB, $listingType, $listingId)
        &&  (/*2 the quiz is not approved (a.k.a locked) (unless the user is an admin) */
                !quizIsApproved($dbh, $quizId) || userIsAdmin()
            )
        );

}

function userIsAdmin(){
    return ($_SESSION['is_admin'] =='true' || $_SESSION['is_super_admin'] =='true');
}

/*workaround */
function convertDirectoryToTable($directory){
    if ($directory == 'topics'){
        return 'quizzes';
    }
    else return $directory;
}


function storeImage($dbh, $imageInfo, $directory, $listingId, $imgType/*quiz, topics, choice[hye,fcm, mc]*/){
      //only proceed if directory and img type are valid (i.e. we are validating to prevent XSS injection or server manipulation)
    //echo "store image function called before validity check.  directory valid: ". isValid('directory', $directory) . "imgtype valid: " .isValid('imgType', $imgType) .", listingId valid: ". is_int($listingId) .", listingId is $listingId; and the opposite of isValidListingId is ". !is_int($listingId);
    if(isValid('directory', $directory) && isValid('imgType', $imgType) /*&& is_int($listingId)*//*for some reason is_int is returning blank for valid numbers*/)
    {
      //  echo "store image function called!<br>";
       // echo $imageInfo, $directory, $listingId, $imgType;
            //Сheck that we have a file
        if((!empty($imageInfo)) && ($imageInfo['error'] == 0)) {
        //    echo "FILES array contains the necessary information<br>";
          //Check if the file is JPEG image and it's size is less than 350Kb
          $clientImageName = basename($imageInfo['name']); 
          $notCroppedExt = strtolower(substr($clientImageName, strrpos($clientImageName, '.') + 1));
          if ( ((($notCroppedExt == "jpg")||($notCroppedExt == "jpeg")) && ($imageInfo["type"] == "image/jpeg")) || ( $notCroppedExt == "png" && $imageInfo["type"] == "image/png" ) && 
            ($imageInfo["size"] < 3000000)) {//3MB file size limit
          //  echo "file meets the size and extension requirements!";
            $croppedExt = '.png';
            $notCroppedExt = '.' . $notCroppedExt;

            //Store notCroppedExt in Database for use in deleting the file, if necessary later.
                storeOriginalExtension($dbh, $notCroppedExt, $directory, $listingId);

            //name the file as "quiz_img";
            $filename = $imgType; //TODO: if choice, test whether its hye, fcm, mc and change based on that.
            //Determine the path to which we want to save this file
              $notcroppedPathFromURL_ROOT = '/app_img/' . $directory . '/' . $listingId . '/notcropped/' ;
              $croppedPathFromURL_ROOT = '/app_img/' . $directory . '/' . $listingId . '/' ;
              //create the directory marked by the quizId, if that directory does not already exist.
              
              mkdir(dirname(dirname(__FILE__)) . '/'. $GLOBALS['HTML_FOLDER'] . $notcroppedPathFromURL_ROOT, 0777, true);
              $newname = dirname(dirname(__FILE__)) . '/' . $GLOBALS['HTML_FOLDER'] .  $notcroppedPathFromURL_ROOT.$filename.$notCroppedExt;
              //Check if the file with the same name is already exists on the server
              if (!file_exists($newname)) {//TODO: See what directories it is looking for in when checking if exists, also change to the timestamp + creator id/username version
                //Attempt to move the uploaded file to it's new place
            //    echo "file name does not already exist!";
                if ((copy($imageInfo['tmp_name'],$newname))) {

              //     echo "It's done! The file has been saved as: ".$newname . " access it at";

                } 
                else {
                   echo "Error: A problem occurred during file upload!. The attempted directory was $newname.";// echo exec('whoami');
                }
              } 
              else {
                 echo "Error: File ".$newname." already exists. Simeoultaneous identical image upload detected from same user account";
              }
          } 
          else {
             echo "Error: Only .jpeg/jpg/png images under 3MB are accepted for images. size (B): ". $imageInfo["size"] .". notCroppedExt: " . $notCroppedExt . ". type: " . $imageInfo["type"];
          }
        } 
        else {
         echo "Error: No file imageed";
        }

        //echo "helloooo$notCroppedExt "; echo exec('whoami');

    //3. get link of image to be stored in database
        $imgLinkNotCropped = $notcroppedPathFromURL_ROOT . $filename . $notCroppedExt;
        $imgLinkCropped = $croppedPathFromURL_ROOT . $filename . $croppedExt;

        return array($imgLinkNotCropped,$imgLinkCropped, $notCroppedExt); 
    }
    else return array(null,null,null);
}
/* - - - - - - - - - - - - - - - - - - - - - - - - */