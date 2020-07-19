<?php

// Please rename me according to the naming convention

// require the config
require_once("inc/config.inc.php");

// require all the entities
require_once("inc/Login/Login.class.php");
require_once("inc/Login/LoginPage.class.php");

// require all the utilities: PDO and DAO(s)
require_once("inc/Login/LoginDAO.class.php");
require_once("inc/Utility/PDOService.class.php");

//Initialize the DAO(s)
LoginDAO::initialize("Login");


//If there was post data from an edit form then process it
if (!empty($_POST)) {
    $sid = $_POST["sid"];
    $pwd = $_POST["PIN"];
    LoginDAO::getUser($sid, $pwd);
}

// Display the header (remeber to set the title/heading)
LoginPage::$title = "User Login";
// Call the HTML header
LoginPage::header();


if (!$sid) {
    // Show description of Login page
    LoginPage::loginDescription();
    // Show login form of Login page
    LoginPage::loginForm();
} else {
    // TODO: Registration page
    LoginPage::success();
}

// Finally I need to call the last function from the HTML
LoginPage::footer();
