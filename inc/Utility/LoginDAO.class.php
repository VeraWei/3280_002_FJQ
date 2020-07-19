<?php

//UserID	PIN

class LoginDAO  {

    //Static DB member to store the database
    private static $db;

    //Initialize the LoginDAO
    static function initialize(string $className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    //Get all the Users
    static function getUser(int $StudentID, string $pwd) {
       
        //QUERY, BIND, EXECUTE, RETURN
        
        try {
            $selectOne = "SELECT * FROM PASSWORDS WHERE StudentID = :StudentID AND Password = :pwd;";
    
            self::$db->query($selectOne);
            self::$db->bind(':StudentID', $StudentID);
            self::$db->bind(':pwd', $pwd);
            self::$db->execute();
            return self::$db->singleResult();

        } catch(PDOException $pe) {
            $pe->getMessage();
        }
        
    }

}


?>