<?php 

RegistrationDAO::initialize('RegistrationUser');
CourseDAO::initialize('Course');
InstructorDAO::initialize('Instructor');

//session_start();
$loggedin = $_SESSION["loggedin"];

if(!empty($_POST)) {
    var_dump($_POST);
    if (empty($_POST["courses"])){
        RegistrationPage::$errors[] = "No course selected.";
    } 
    else {
        if($_POST['action'] == 'Register') {
            $CourseID = new Course;
            $RegistrationInfo = explode('-', $_POST['courses']);
            $CourseID->setSubject($RegistrationInfo[0]);
            $CourseID->setCRN($RegistrationInfo[1]);
            $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
            RegistrationDAO::addRegistration($CourseInfoToAdd, $loggedin);
            if (empty(RegistrationPage::$errors)) {
                $messages[] = "Registration Success.";
            }
             
            //unset($_POST);
        }
        if($_POST['action'] == 'Show Info') {
            $CourseID = new Course;
            $courseInfo = explode('-', $_POST['courses']);
            $CourseID->setCRN($courseInfo[1]);
            $CourseID->setSubject($courseInfo[0]);
            $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
            $Instructor = InstructorDAO::getInstructorInfo($CourseInfoToAdd->getInstructorID());
            RegistrationPage::$CourseInfo = $CourseInfoToAdd;
            RegistrationPage::$Instructor = $Instructor;
        }
    }
} else {
    /*
    if ($_GET["route"]="delete-registration"){
        RegistrationDAO::deleteRegistration();
        
        unset($_GET["route"]);
        header('Location: CourseRegistration.php');
    } 
    */   
}



RegistrationPage::$RegistrationUser = RegistrationDAO::getCourses($loggedin);
RegistrationPage::$CourseList = RegistrationDAO::getCourseList();
RegistrationPage::renderContents();

?>