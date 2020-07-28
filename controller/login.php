<?php

// Please rename me according to the naming convention

// require the config
require_once("../inc/config.inc.php");
require_once("../inc/dbconfig.inc.php");

// require all the entities
require_once("../inc/Entity/User.class.php");
require_once("../inc/Entity/LoginPage.class.php");

// require all the utilities: PDO and DAO(s)
require_once("../inc/Utility/LoginManager.class.php");
require_once("../inc/Utility/UserDAO.class.php");
require_once("../inc/Utility/PDOService.class.php");
require_once("../inc/Utility/Validate.class.php");


// Display the header (remeber to set the title/heading)
LoginPage::$title = "User Login";
// Call the HTML header
LoginPage::header();

if (!empty($_POST))   {
    
    //Initialize the DAO
    UserDAO::init();

    //Get the current user 

    $authUser = UserDAO::getUser($_POST['username']);
    //Check the DAO returned an object of type user

    //Verify the password with the posted data
    
    if ($authUser->verifyPassword($_POST['PIN']))  {

        //Start the session
        session_start();
        
        //Set the user to logged in
        $_SESSION['loggedin'] = $authUser->getStudentID();
        head("Location: CourseRegistration.php");
        
    }
        
    //Use header to send the user to the user profile page
    if (LoginManager::verifyLogin())    {
        // $u = UserDAO::getUser($_SESSION['loggedin']);
        header('Location: CourseRegistration.php');
        // it should locate to the next page;
    }
}
    
// Show login form of Login page
LoginPage::loginDescription();
LoginPage::loginForm();

// Finally I need to call the last function from the HTML
LoginPage::footer();
