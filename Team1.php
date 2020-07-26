<?php
// require the config
require_once('inc/config.inc.php');
require_once("inc/html_form.inc.php");
require_once("inc/entity/RouteTestPage.class.php");
require_once("inc/utility/Route.class.php");

// require all the entities
require_once("inc/Entity/Login.class.php");
require_once("inc/Entity/LoginPage.class.php");

// require all the utilities: PDO and DAO(s)
require_once("inc/Utility/LoginDAO.class.php");
require_once("inc/Utility/PDOService.class.php");


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


$var = "This is a line added by Fernando";

?>