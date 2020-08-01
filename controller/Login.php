<?php

// Define Login page title
LogPage::$title = "User Login";

// Call the HTML header
LogPage::header();

$error = null;
if (!empty($_POST))   {
    
    //Initialize the DAO
    UserDAO::init();

    
    
    //Get the current user 
    $authUser = UserDAO::getUser($_POST['username']);
    
    //Verify the password with the posted data
    if ($authUser && ($authUser->verifyPassword($_POST['PIN'])))  {

        //Start the session
        session_start();
        
        //Set the user to logged in
        $_SESSION['loggedin'] = $authUser->getStudentID();
    } else {
        $error = "Wrong User/Password";
    }
    
    
}

//Verify logged user
if (LoginManager::verifyLogin())    {

    header('Location: CourseRegistration.php');

} else {

    // Show login form of Login page
    LogPage::loginDescription($error);
    LogPage::loginForm();
} 

LogPage::footer();
