<?php 

RegistrationDAO::initialize('RegistrationUser');
CourseDAO::initialize('Course');
InstructorDAO::initialize('Instructor');
TuitionDAO::initialize('Tuition');

//session_start();
$loggedin = $_SESSION["loggedin"];

if(!empty($_POST)) {
    if(isset($_POST['TuitionSubmit'])) {
        TuitionDAO::updateTuition($loggedin, ($_POST['payment'] + 0) * (-1));
    } 
    elseif (empty($_POST["courses"])){
        RegistrationPage::$errors[] = "No course selected.";
    } 
    else {
        if($_POST['action'] == 'Register') {
            $CourseID = new Course;
            $RegistrationInfo = explode('-', $_POST['courses']);
            $CourseID->setSubject($RegistrationInfo[0]);
            $CourseID->setCRN($RegistrationInfo[1]);
            $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
            try{
            RegistrationDAO::addRegistration($CourseInfoToAdd, $loggedin);
            }
            catch(Exception $e){
                RegistrationPage::$errors[] = "Failed to add course. Please check if it's already added";
            }
            if (empty(RegistrationPage::$errors)) {
                $messages[] = "Registration Success.";
            }
            
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
    
    if ($_GET["route"]=="delete-registration"){
        RegistrationDAO::deleteRegistration();
        
        unset($_GET["route"]);
        header('Location: CourseRegistration.php');
        exit;
    } 
      
}



RegistrationPage::$RegistrationUser = RegistrationDAO::getCourses($loggedin);
RegistrationPage::$CourseList = RegistrationDAO::getCourseList();
RegistrationPage::$Tuition = TuitionDAO::getTuition($loggedin);
RegistrationPage::renderContents();

?>