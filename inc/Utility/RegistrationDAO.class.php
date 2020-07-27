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
    static function createReservation(Reservation $newReservation) {

        $sqlInsert = "INSERT INTO reservation (Name, Email, FacilityID, ReservationDate, Length)
        VALUES (:name, :email, :facilityid, :reservationdate, :length);";

        // QUERY BIND EXECUTE RETURN
        self::$db->query($sqlInsert);
        self::$db->bind(':name',$newReservation->getName());
        self::$db->bind(':email',$newReservation->getEmail());
        self::$db->bind(':facilityid', $newReservation->getFacilityID());
        self::$db->bind(':reservationdate',$newReservation->getReservationDate());
        self::$db->bind(':length',$newReservation->getLength());

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

    // GET = READ = SELECT ALLL
    // This is to get all reservations 
    static function getReservations() {

        // I don't need any parameter here, do I need to bind?
        //Prepare the Query
        $selectAll = "SELECT * FROM reservation;";
        self::$db->query($selectAll);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->resultSet();
    }


    
    // UPDATE means update
    static function updateReservation (Reservation $ReservationToUpdate) {
        $updateQuery = "UPDATE reservation
        SET Name = :name,
            ReservationDate = :date,
            Length = :length,
            FacilityID = :facilityid
            WHERE ReservationID = :reservationid;";
        //QUERY, BIND, EXECUTE
        self::$db->query($updateQuery);
        self::$db->bind(':name', $_POST['name']);
        self::$db->bind(':date', $_POST['ReservationDate']);
        self::$db->bind(':length', $_POST['length']);
        self::$db->bind(':facilityid', $_POST['facilityid']);
        self::$db->bind(':reservationid', $ReservationToUpdate->getReservationID());
        self::$db->execute();
        // Return the rowCount
        return self::$db->rowCount();

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

    // WE NEED TO JOIN HERE
    // Make sure to select from both tables joined at the correct column
    static function getReservationList() {
        $query = "SELECT *  FROM reservation JOIN facility
        ON reservation.FacilityID = facility.FacilityID;";
        //Prepare the Query
        self::$db->query($query);
        //execute the query
        self::$db->execute();
        //Return row results
        return self::$db->resultSet();
    }

}


?>