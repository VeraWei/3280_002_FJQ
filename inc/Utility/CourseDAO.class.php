<?php 
    
    class CourseDAO {
        public static $db;
        static function initialize($className)    {
        self::$db = new PDOService($className);
    }

    static function getCourseInfo(Course $CourseID) {
        $query = "SELECT *  FROM courses WHERE Subject = :subject AND CRN = :crn;";
        self::$db->query($query);
        self::$db->bind(':subject', $CourseID->getSubject());
        self::$db->bind(':crn', $CourseID->getCRN());
        self::$db->execute();
        return self::$db->singleResult();
        
    }
}
?>