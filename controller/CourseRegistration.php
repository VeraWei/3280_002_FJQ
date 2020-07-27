<?php 
require_once("../inc/config.inc.php");
require_once("../inc/dbconfig.inc.php");

require_once("../inc/Utility/LoginManager.class.php");
require_once("../inc/Utility/PDOService.class.php");
require_once("../inc/Utility/UserDAO.class.php");
require_once("../inc/Utility/Validate.class.php");
require_once("../inc/Utility/RegistrationDAO.class.php");
require_once("../inc/Entity/RegistrationPage.class.php");
require_once("../inc/Entity/RegistrationUser.class.php");

RegistrationDAO::initialize('RegistrationUser');
//if(isset($_POST['username'])){
$RegistrationUser = RegistrationDAO::getCourse(/*$_POST['username']*/ 300000000);
    var_dump($RegistrationUser);
//}

RegistrationPage::PrintHeader();
RegistrationPage::printTable($RegistrationUser);
RegistrationPage::PrintForm();
RegistrationPage::PrintFooter();
?>