<?php

class RegistrationDAO  {


    //Static DB member to store the database    
    public static $db;
    //Initialize the ReservationDAO
    static function initialize($className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    // One of the functionality for the class abstracted by this DAO: CREATE
    // Remember that Create means INSERT
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
        WHERE CRN = :crn AND WHERE Subject = :sub;";
        self::$db->query($sqlUpdate);
        self::$db->bind(':ernl', $Enrl);
        self::$db->bind(':Rem', $Rem);
        self::$db->bind(':Wait', $Wait);
        self::$db->bind(':crn', $CRN);
        self::$db->bind(':sub', $Subject);
        self::$db->execute();

        $sqlInsert = "INSERT INTO students_courses VALUES(:CRN, :StudentID, :RegistrationDate);";

        // QUERY BIND EXECUTE RETURN
        self::$db->query($sqlInsert);
        self::$db->bind(':CRN',$RegistrationUser->getCRN());
        self::$db->bind(':StudentID', $userID);
        self::$db->bind(':RegistrationDate', date("Y-m-d"));
        self::$db->execute();
        return self::$db->lastInsertedId();
    }
    
    // GET = READ = SELECT
    // This is for a single result.... when do I need it huh?
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
        
        //QUERY, BIND, EXECUTE, RETURN
        self::$db->query($selectCourses);
        self::$db->execute();
        return self::$db->resultSet();
    }
    
    // DELETE
    static function deleteReservation(int $ReservationId) {

        // Yea...yea... it is a drill like the one before        

            $deleteQuery = "DELETE FROM reservation WHERE ReservationID = :reservationid;";
    
            try{
                self::$db->query($deleteQuery);
                self::$db->bind(':reservationid', $ReservationId);
                self::$db->execute();
    
                if(self::$db->rowCount() != 1){
                    throw new Exception("Problem in deleting book $ReservationId");
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
    
            return true;
        
    }

}


?>