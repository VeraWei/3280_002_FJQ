<?php 
require_once("inc/config.inc.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/PDOService.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/Validate.class.php");
require_once("inc/Entity/RegistrationPage.class.php");
require_once("inc/Entity/RegistrationUser.class.php");

RegistrationPage::PrintHeader();
RegistrationPage::printTable();
RegistrationPage::PrintForm();
RegistrationPage::PrintFooter();
?>