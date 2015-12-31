<?php
include_once 'db_config.php';
include_once 'login_connect.php';
require_once 'functions.php';

 
$register_error_msg = "";

if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $register_error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    $client_side_password = $password;
    //echo "The password as passed to this file is $password";
    if (strlen($password) != 128) {
        // The hashed pass should be 128 characters long.
        // If it's not, something really odd has happened
        $register_error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
    $sql = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $logDB->prepare($sql);
 
   // check existing email  
    if ($stmt) {
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) { //TODO: stmt->rowCount() isn't portable for SELECT statements beyond MySQL. would have to count rows differently
            // A user with this email address already exists
            $register_error_msg .= '<p class="error">A user with this email address already exists.</p>. Result is the following ' . print_r($result);
                        $stmt = null;
                        $result = null;
        }
    //$stmt->close(); (appears to be an extraneous call)
    } else {
        $register_error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt = null;
                $result = null;
    }
 
    // check existing username
    $sql = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $logDB->prepare($sql);
 
    if ($stmt) {
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetch();
 
                if ($stmt->rowCount()> 0) {
                        // A user with this username already exists
                        $register_error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt = null;
                        $result = null;
                }
                $stmt = null;
                $result = null;
        } else {
                $register_error_msg .= '<p class="error">Database error line 55</p>';
                $stmt = null;
                $result = null;
        }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($register_error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));//may not be truly random. should check on this. hmm, it looks like it is.
 
        // Create salted password 
     //   echo "The unhashed password is $password<br>";
        $password = hash('sha512', $password . $random_salt);
    //    echo "the hashed password is $password<br>";
   //    echo "The salt is $random_salt<br>";
 
        // Insert the new user into the database 
        if ($insert_stmt = $logDB->prepare("INSERT INTO members (username, email, password, salt, is_approved, is_admin, is_super_admin) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $params = array($username, $email, $password, $random_salt, "false", "false", "false");
            // Execute the prepared query.
            if (! $insert_stmt->execute($params)) {
                echo "The insert registration statement failed";
                header('Location: error.php?err=Registration failure: INSERT');//TODO: may not work when someone is logging in from some directory other than home/
            }
            else{
                //log the user in
                session_start();
                    if (login($email, $client_side_password, $logDB) == true) {
                    // Login success 
                    header('Location: '.$_SERVER['REQUEST_URI']); // Redirect them to the page from which they created their account
                    } else {
                    // Login failed 
                    header('Location: '.$_SERVER['REQUEST_URI'] . '?error=401&description="Bad Login"'); // Bad login
                    // echo "login failed";
                    }
            }
        }
        //header('Location: register_success.php'); // TODO: change path once this hits production and add error codes
    } 
    else echo $register_error_msg;
}
