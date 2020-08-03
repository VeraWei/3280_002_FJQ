<?php 

RegistrationDAO::initialize('RegistrationUser');
CourseDAO::initialize('Course');
InstructorDAO::initialize('Instructor');
TuitionDAO::initialize('Tuition');

$loggedin = $_SESSION["loggedin"];
//A post was submitted
if(!empty($_POST)) {
    //Post came from Tuition payment button
    if(isset($_POST['TuitionSubmit'])) {
        TuitionDAO::updateTuition($loggedin, ($_POST['payment'] + 0) * (-1));
    } 
    //Course not selected
    elseif (empty($_POST["courses"])){  
        RegistrationPage::$errors[] = "No course selected.";
    } 
    else {
        //Post came from Register button
        if($_POST['action'] == 'Register') { 
            $CourseID = new Course;
            $RegistrationInfo = explode('-', $_POST['courses']);
            $CourseID->setSubject($RegistrationInfo[0]);
            $CourseID->setCRN($RegistrationInfo[1]);
            $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
            // Exception handling for avoiding duplication
            try{
                RegistrationDAO::addRegistration($CourseInfoToAdd, $loggedin);
            }
            catch(Exception $e){
                //These errors will be printed
                RegistrationPage::$errors[] = "Failed to add course. Please check if it's already added";
            }
            if (empty(RegistrationPage::$errors)) {
                $messages[] = "Registration Success.";
            }
        }
        //Post came from Show Info button
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
    //Dropping a course
    if ($_GET["route"]=="delete-registration"){
        RegistrationDAO::deleteRegistration();
        TuitionDAO::updateTuition($loggedin, -600);
        header('Location: CourseRegistration.php');
        exit;
    }   
}

//Show the Page
RegistrationPage::$RegistrationUser = RegistrationDAO::getCourses($loggedin);
RegistrationPage::$CourseList = RegistrationDAO::getCourseList();
RegistrationPage::$Tuition = TuitionDAO::getTuition($loggedin);
RegistrationPage::renderContents();

?>