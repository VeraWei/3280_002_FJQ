<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {

        //Check for a session
        if (session_id() == '' && !isset($_SESSION)) {

            //Start it up
            session_start();
        }
        //If there is session data
        if (isset($_SESSION["loggedin"]))  {

            //The user is loggedin, return true
            return true;

        // Else
        } else {

            //The user is not logged in
            //Destroy any session
            session_destroy();
                        
            //return false
            return false;
        }
        
        // End else
    }
}

?>