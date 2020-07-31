<?php 
    class InstructorDAO {
        public static $db;
        static function initialize($className)    {
            self::$db = new PDOService($className);
        }

        static function getInstructorInfo(int $instructorID) {
            $query = "SELECT * FROM instructors WHERE InstructorID = :instructorID;";
            self::$db->query($query);
            self::$db->bind(':instructorID', $instructorID);
            self::$db->execute();
            return self::$db->singleResult();
        }
    }
?>