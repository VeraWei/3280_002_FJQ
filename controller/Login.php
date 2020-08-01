<?php

// Display the header (remeber to set the title/heading)
LogPage::$title = "User Login";
// Call the HTML header
LogPage::header();
$error = null;
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
        
    } else {

        $error = "Password Error!";
    }
        
    
}
//Use header to send the user to the user profile page
if (LoginManager::verifyLogin())    {
    // $u = UserDAO::getUser($_SESSION['loggedin']);
    header('Location: CourseRegistration.php');
// it should locate to the next page;
} else {

    // Show login form of Login page
    LogPage::loginDescription($error);
    LogPage::loginForm();
} 

// Finally I need to call the last function from the HTML
LogPage::footer();
