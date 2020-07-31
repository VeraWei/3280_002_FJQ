<?php
/**
 * Group 1
 * 
 * Viana Maia Fernando 300320728 (Team Leader)
 * Giladi Joel         300302313
 * Wei Qiuming         300312797
 * 
 * 
 */
// require the config
require_once('inc/config.inc.php');

//Entity classes
require_once("inc/entity/Course.class.php");
require_once("inc/entity/SuperPage.class.php");
require_once("inc/entity/InstallDBPage.class.php");
require_once("inc/entity/LogPage.class.php");
require_once("inc/entity/RegistrationPage.class.php");
require_once("inc/entity/RegistrationUser.class.php");
require_once("inc/entity/RouteTestPage.class.php");
require_once("inc/entity/Tuition.class.php");
require_once("inc/entity/User.class.php");
// require_once("inc/entity/Instructor.class.php");

//Uility classes
require_once("inc/utility/LoginManager.class.php");
require_once("inc/utility/PDOService.class.php");
require_once("inc/utility/RegistrationDAO.class.php");
require_once("inc/utility/CourseDAO.class.php");
require_once("inc/utility/InstructorDAO.class.php");
require_once("inc/utility/Route.class.php");
require_once("inc/utility/TuitionDAO.class.php");
require_once("inc/utility/UserDAO.class.php");
require_once("inc/utility/Validate.class.php");

// Controller classes
require_once("controller/InstallDBController.class.php");

// require the dbconfig
$inc = 'inc/dbconfig.inc.php';
if (!file_exists($inc)) {
    //Seems like the server is not ready for this application.
    //take the user to the Database Setup Page
    //Routes available for this app while file 'inc/dbconfig.inc.php' is missing: 
    Route::dispatchRequest("Team1.php",function () { InstallDBController::onGet() ; }, "GET");
    Route::dispatchRequest("Team1.php",function () { InstallDBController::onPost() ; }, "POST");
    Route::onRequestNotDispatched();
    exit; //only goes to the following instructions after creating 'inc/dbconfig.inc.php' on the server.
}
require_once($inc);

/***
* Routes for this application 
**/

//Routes to Login
$loginFunction = function () { require_once("controller/Login.php"); } ; //anonymous function for invoking login controller.
Route::dispatchRequest("Team1.php",$loginFunction);
//Route::dispatchRequest("controller/Login.php", $loginFunction);

//Routes to Login Out
$logOutFunction = function () { require_once("controller/LogOut.php"); } ; //anonymous function for invoking login out controller.
//Route::dispatchRequest("controller/LogOut.php",$logOutFunction);
Route::dispatchRequest("LogOut.php", $logOutFunction);

// Main page
$courseRegistrationFunction = function () { require_once("controller/CourseRegistration.php"); };
//Route::dispatchRequest("controller/CourseRegistration.php",$courseRegistrationFunction); //Joel is testing this URL
Route::dispatchRequest("CourseRegistration.php",$courseRegistrationFunction); //Vera is redirecting to this URL in login controller

//Test 
//Route::dispatchRequest("test-page",function () { RouteTestPage::renderContents(); });
//Route::dispatchRequest("another-test",function () { RouteTestPage::renderContents(); }, "GET");

// Succes at installing DB. InstallDBPage
//Route::dispatchRequest("install-db-is-ok",function () { InstallDBPage::renderContents(); }, "GET");

//Deal with not dispatched requests.
Route::onRequestNotDispatched();

?>