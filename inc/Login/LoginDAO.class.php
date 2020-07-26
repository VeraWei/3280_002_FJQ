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
    // static function getUser() {
        
    //     // SELECT
    //     $selectAll = "SELECT * FROM User;";
        
        
    //     //Prepare the Query
    //     self::$db->query($selectAll);
        
    //     //Return the results
    //     self::$db->execute();
        
    //     //Return the resultSet
    //     return self::$db->resultSet();       
        
    // }

    // change pin
    static function changePIN(String $newPin) {

        return true;  
    }
}


?>