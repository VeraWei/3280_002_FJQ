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




    if(!empty($_POST)) {
        if($_POST['action'] == 'Register') {
        var_dump($_POST);
       
        $RegistrationUser = new RegistrationUser;
        $courseID = explode('-', $_POST['courses']);
        var_dump($courseID);
        $RegistrationUser->setSubject($courseID[0]);
        $RegistrationUser->setCRN($courseID[1]);
        RegistrationDAO::addRegistration($RegistrationUser, 300000000);
        unset($_POST);
        
        
        }


}

$RegistrationUser = RegistrationDAO::getCourses(/*$_POST['username']*/ 300000000);
    //var_dump($RegistrationUser);
$CourseList = RegistrationDAO::getCourseList();
//var_dump($CourseList);

//}

RegistrationPage::PrintHeader();
RegistrationPage::printTable($RegistrationUser);
RegistrationPage::PrintForm($CourseList);


    if(!empty($_POST)) {
        if($_POST['action'] == 'Show Info') {
    $CourseID = new RegistrationUser;
    $courseInfo = explode('-', $_POST['courses']);
    $CourseID->setCRN($courseInfo[1]);
    $CourseID->setSubject($courseInfo[0]);
    $CourseInfoToAdd = RegistrationDAO::getCourseInfo($CourseID);
    RegistrationPage::PrintCourseInfo($CourseInfoToAdd);
    }
}

RegistrationPage::PrintFooter();
?>