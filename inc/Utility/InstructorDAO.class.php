<?php 
/* 
1. Instructor
+----------------+-------------+------+-----+---------+----------------+
| Field          | Type        | Null | Key | Default | Extra          |
+----------------+-------------+------+-----+---------+----------------+
| InstructorID   | int         | NO   | PRI | NULL    | auto_increment |
| InstructorName | char(35)    | NO   |     | NULL    |                |
| Phone          | char(25)    | NO   |     | NULL    |                |
| Email          | varchar(35) | NO   |     | NULL    |                |
+----------------+-------------+------+-----+---------+----------------+

*/
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