<?php

class RegistrationDAO  {

    //Static DB member to store the database    
    public static $db;
    //Initialize the RegistrationDAO
    static function initialize($className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    static function addRegistration(Course $RegistrationCourse, $userID) {
        $Enrl = $RegistrationCourse->getEnrl();
        $Rem = $RegistrationCourse->getRem();
        $Wait = $RegistrationCourse->getWait();
        $CRN = $RegistrationCourse->getCRN();
        $Subject = $RegistrationCourse->getSubject();

        if($Rem <= 0)
            $Wait++;
        else {
            $Enrl++;
            $Rem--;
        }

        $sqlUpdate = "UPDATE courses 
        SET Enrl = :enrl, Rem = :Rem, Wait = :Wait 
        WHERE CRN = :crn AND Subject = :sub;";
        self::$db->query($sqlUpdate);
        self::$db->bind(':enrl', $Enrl);
        self::$db->bind(':Rem', $Rem);
        self::$db->bind(':Wait', $Wait);
        self::$db->bind(':crn', $CRN);
        self::$db->bind(':sub', $Subject);
        self::$db->execute();

        $sqlInsert = "INSERT INTO students_courses VALUES(:CRN, :StudentID, :RegistrationDate, :Subject);";

        // QUERY BIND EXECUTE RETURN
        self::$db->query($sqlInsert);
        self::$db->bind(':CRN',$RegistrationCourse->getCRN());
        self::$db->bind(':StudentID', $userID);
        self::$db->bind(':RegistrationDate', date("Y-m-d"));
        self::$db->bind(':Subject', $Subject);
        self::$db->execute();

        TuitionDAO::updateTuition($userID, 600);
    }
    
    static function getCourses(int $StudentID)  {
        $selectCourses = "SELECT * FROM COURSES JOIN STUDENTS_COURSES
        ON COURSES.CRN = STUDENTS_COURSES.CRN JOIN STUDENTS
        ON STUDENTS_COURSES.StudentID = STUDENTS.StudentID
        WHERE STUDENTS.StudentID = :studentid";
        
        //QUERY, BIND, EXECUTE, RETURN
        self::$db->query($selectCourses);
        self::$db->bind(':studentid', $StudentID);
        self::$db->execute();
        return self::$db->resultSet();

    }

    static function getCourseList()  {
        $selectCourses = "SELECT Subject, CRN FROM COURSES;";
        
        self::$db->query($selectCourses);
        self::$db->execute();
        return self::$db->resultSet();
    }
    
    // Drop Registration
    static function deleteRegistration() {
        $StudentId = $_SESSION['loggedin'];
        $deleteQuery = "DELETE FROM Students_Courses WHERE StudentId = :StudentId And CRN = :CRN And Subject = :Subject ;";
    
        self::$db->query($deleteQuery);
        self::$db->bind(':StudentId', $StudentId);
        self::$db->bind(':CRN', $_GET["crn"]);
        self::$db->bind(':Subject', $_GET["subject"]);

        self::$db->execute();

        if(self::$db->rowCount() != 1){
            $errorMsg = "Problem deleting course registration";
            error_log($errorMsg);
        }    
    }

}


?>