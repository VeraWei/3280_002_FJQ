<?php

// Please rename me according to the naming convention

// require the config
require_once("../inc/config.inc.php");

// require all the entities
require_once("../inc/Entity/User.class.php");
require_once("../inc/Entity/Page.class.php");

// require all the utilities: PDO and DAO(s)
require_once("../inc/Utility/LoginManager.class.php");
require_once("../inc/Utility/UserDAO.class.php");
require_once("../inc/Utility/PDOService.class.php");
require_once("../inc/Utility/Validate.class.php");


// Display the header (remeber to set the title/heading)
Page::$title = "Detail";
// Call the HTML header
Page::header();

// Finally I need to call the last function from the HTML
Page::footer();
