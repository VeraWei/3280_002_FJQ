<?php

/*
+-----------------+-------------+------+-----+---------+----------------+
| Field           | Type        | Null | Key | Default | Extra          |
+-----------------+-------------+------+-----+---------+----------------+
| ReservationID   | smallint(5) | NO   | PRI | NULL    | auto_increment |
| Name            | varchar(50) | YES  |     | NULL    |                |
| Email           | varchar(50) | YES  |     | NULL    |                |
| FacilityID      | tinyint(3)  | YES  | MUL | NULL    |                |
| ReservationDate | date        | YES  |     | NULL    |                |
| Length          | tinyint(3)  | YES  |     | NULL    |                |
| Venue           | tinytext    | YES  |     | NULL    |                |
+-----------------+-------------+------+-----+---------+----------------+
*/

class ReservationDAO  {

    //Static DB member to store the database    
    private static $db;

    //Initialize the ReservationDAO
    static function initialize(string $className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    // One of the functionality for the class abstracted by this DAO: CREATE
    // Remember that Create means INSERT
    static function createReservation(Reservation $newReservation) {

        // QUERY BIND EXECUTE RETURN

        $sqlInsert = "INSERT INTO reservation (Name, Email, FacilityID, ReservationDate , Length)
            VALUES (:name, :email, :facilityID, :reservationDate, :length)";
        
        self::$db->query($sqlInsert);
        self::$db->bind(':name',$newReservation->getName());
        self::$db->bind(':email',$newReservation->getEmail());
        self::$db->bind(':facilityID',$newReservation->getFacilityID());
        self::$db->bind(':reservationDate',$newReservation->getReservationDate());
        self::$db->bind(':length',$newReservation->getLength());

        self::$db->execute();
        return self::$db->lastInsertedId();

    }
    
    // GET = READ = SELECT
    // This is for a single result.... when do I need it huh?
    static function getReservation(int $reservationId)  {
        
        //QUERY, BIND, EXECUTE, RETURN
             
        $selectOne = "SELECT * FROM reservation WHERE ReservationID = :reservationId;";

        self::$db->query($selectOne);
        self::$db->bind(':reservationId', $reservationId);
        self::$db->execute();
        return self::$db->singleResult();
    }

    // GET = READ = SELECT ALLL
    // This is to get all reservations 
    static function getReservations() {

        // I don't need any parameter here, do I need to bind?
        $selectAll = "SELECT * FROM reservation;";
        
        //Prepare the Query
        self::$db->query($selectAll);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->resultSet();
    }
    
    // UPDATE means update
    static function updateReservation (Reservation $ReservationToUpdate) {

        //QUERY, BIND, EXECUTE
        $sqlUpdate = "UPDATE reservation
            SET Name=:name,
                FacilityID=:facilityID,
                ReservationDate=:reservationDate,
                Length=:length
            WHERE ReservationID=:reservationId";
    
        $id = $ReservationToUpdate->getReservationID();

        self::$db->query($sqlUpdate);
        self::$db->bind(':name',$ReservationToUpdate->getName());
        self::$db->bind(':facilityID',$ReservationToUpdate->getFacilityID());
        self::$db->bind(':reservationDate',$ReservationToUpdate->getReservationDate());
        self::$db->bind(':length',$ReservationToUpdate->getLength());
        self::$db->bind(':reservationId', $id);

        self::$db->execute();
        // Return the rowCount

        return self::$db->rowCount();

    }
    
    // DELETE
    static function deleteReservation(int $reservationId) {

        // Yea...yea... it is a drill like the one before        
        $deleteQuery = "DELETE FROM reservation WHERE ReservationID = :reservationId;";

        try{
            self::$db->query($deleteQuery);
            self::$db->bind(':reservationId', $reservationId);
            self::$db->execute();

            if(self::$db->rowCount() != 1){
                throw new Exception("Problem in deleting reservation $reservationId");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
            self::$db->debugDumpParams();
            return false;
        }

        return true;

    }

    // WE NEED TO JOIN HERE
    // Make sure to select from both tables joined at the correct column
    static function getReservationList() {
        
        //Prepare the Query
        $sql = "SELECT *
			FROM Reservation
			LEFT JOIN Facility
			ON Facility.FacilityID = Reservation.FacilityID
			WHERE Reservation.FacilityID = Facility.FacilityID";
        //execute the query
        self::$db->query($sql);
        self::$db->execute();
        //Return row results
        return self::$db->resultSet();
    }

}


?>