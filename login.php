<?php

// Please rename me according to the naming convention

// require the config
require_once("inc/config.inc.php");
require_once("inc/html_form.inc.php");

// require all the entities
require_once("inc/Entity/Login.class.php");
require_once("inc/Entity/LoginPage.class.php");

// require all the utilities: PDO and DAO(s)
require_once("inc/Utility/LoginDAO.class.php");
require_once("inc/Utility/PDOService.class.php");

//Initialize the DAO(s)
LoginDAO::initialize("Login");


//If there was post data from an edit form then process it
if (!empty($_POST)) {
    $sid = $_POST["sid"];
    $pwd = $_POST["PIN"];
    
    // check format first
    $validate = validateForm($sid, $pwd);
    if ($validate == "pass") {
        
        // check if student id and password is met with database table
        $user = LoginDAO::getUser($sid, $pwd);
        if (!$user) {
            $error = "Please input your studentID and password correctly!";
        }

    } else {
        $error = $validate;
    }
}

// Display the header (remeber to set the title/heading)
LoginPage::$title = "User Login";
// Call the HTML header
LoginPage::header();


if (!$sid || $error) {
    // Show description of Login page
    LoginPage::loginDescription($error);
    // Show login form of Login page
    LoginPage::loginForm();
} else {
    LoginPage::success();
}

// Finally I need to call the last function from the HTML
LoginPage::footer();
