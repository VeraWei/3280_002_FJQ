<?php

/*

+-----------+--------------+------+-----+---------+-------+
| Field     | Type         | Null | Key | Default | Extra |
+-----------+--------------+------+-----+---------+-------+
| StudentID | int          | NO   | PRI | NULL    |       |
| Password  | varchar(250) | NO   |     | NULL    |       |
+-----------+--------------+------+-----+---------+-------+
 
*/

class UserDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init() {
        self::$db = new PDOService("User");
    }

    //Get all the Users
    static function getUser(int $StudentID) {
       
        //QUERY, BIND, EXECUTE, RETURN
        
        try {
            $selectOne = "SELECT * FROM USERS WHERE StudentID = :StudentID;";
    
            self::$db->query($selectOne);
            self::$db->bind(':StudentID', $StudentID);
            self::$db->execute();
            return self::$db->singleResult();

        } catch(PDOException $pe) {
            $pe->getMessage();
        }
        
        return self::$db->singleResult();

    }



    // get multiple users detail
    // It is not needed in our app, but hey.. more practice is better!
    static function getUsers()  {
        //you know the drill
        $sql = "SELECT * FROM users;";
        self::$db->query($sql);
        self::$db->execute();
        
        return self::$db->getResultSet();
    }
    
    
}

?>