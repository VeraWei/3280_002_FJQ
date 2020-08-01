<?php

class UserDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init() {
        self::$db = new PDOService("User");
    }

    //Get user
    static function getUser(int $StudentID) {
       
        //QUERY, BIND, EXECUTE, RETURN
        
        try {
            $selectOne = "SELECT * FROM USERS WHERE StudentID = :StudentID;";
    
            self::$db->query($selectOne);
            self::$db->bind(':StudentID', $StudentID);
            self::$db->execute();
        } catch(PDOException $pe) {
            error_log($pe->getMessage());
        }
        
        return self::$db->singleResult();

    }

  
}

?>