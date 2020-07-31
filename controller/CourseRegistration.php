<?php 


RegistrationDAO::initialize('RegistrationUser');
CourseDAO::initialize('Course');
InstructorDAO::initialize('Instructor');

    if(!empty($_POST)) {
        if($_POST['action'] == 'Register') {
        $CourseID = new Course;
        $RegistrationInfo = explode('-', $_POST['courses']);
        $CourseID->setSubject($RegistrationInfo[0]);
        $CourseID->setCRN($RegistrationInfo[1]);
        $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
        RegistrationDAO::addRegistration($CourseInfoToAdd, 300000000);
        unset($_POST);
        }
}

$RegistrationUser = RegistrationDAO::getCourses(/*$_SESSION['loggedin']*/ 300000000);

$CourseList = RegistrationDAO::getCourseList();

RegistrationPage::PrintHeader();
RegistrationPage::printTable($RegistrationUser);
//Fernando's function here
RegistrationPage::PrintForm($CourseList);




if(!empty($_POST)) {
    if($_POST['action'] == 'Show Info') {
        $CourseID = new Course;
        $courseInfo = explode('-', $_POST['courses']);
        $CourseID->setCRN($courseInfo[1]);
        $CourseID->setSubject($courseInfo[0]);
        $CourseInfoToAdd = CourseDAO::getCourseInfo($CourseID);
        $Instructor = InstructorDAO::getInstructorInfo($CourseInfoToAdd->getInstructorID());
        RegistrationPage::PrintCourseInfo($CourseInfoToAdd, $Instructor);
        
    }
}

RegistrationPage::PrintFooter();

?>