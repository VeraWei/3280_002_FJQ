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
//require_once("inc/html_form.inc.php");
require_once("inc/entity/RouteTestPage.class.php"); //Actually should be the SuperPage here
require_once("inc/entity/InstallDBPage.class.php");
// require all the entities
require_once("inc/Login/Login.class.php");
require_once("inc/Login/LoginPage.class.php");

// require all the utilities: PDO and DAO(s)
require_once("inc/Login/LoginDAO.class.php");
require_once("inc/Utility/PDOService.class.php");

require_once("inc/utility/Route.class.php");

// require the dbconfig
$inc = 'inc/dbconfig.inc.php';
if (!file_exists($inc)) {
    //Seems like the server is not ready for this application.
    //Redirects, on the server-side, to the Database Setup page
    require("controller/installdb.php");
    exit;
}
require_once($inc);


/***
* Routes for this application 
**/

// Page: Team1.php
// Method GET or POST, route = "", then execute the script login.php
Route::set("GET","",function () {
    require('login.php');
});
Route::set("POST","",function () {
    require('login.php');
});

// Page: Team1.php?route=test-page
// Method GET or POST, route = "", then execute the script login.php
Route::set("GET","test-page",function () {
    RouteTestPage::renderContents();
});


Route::handleRequestsNotDispatched();

?>