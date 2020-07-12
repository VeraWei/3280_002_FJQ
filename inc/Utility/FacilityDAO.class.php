<?php

//FacilityID	FacilityName	Description

class FacilityDAO  {

    //Static DB member to store the database
    private static $db;

    //Initialize the FacilityDAO
    static function initialize(string $className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    //Get all the Facility
    static function getFacility() {
        
        // SELECT
        $selectAll = "SELECT * FROM Facility;";
        
        
        //Prepare the Query
        self::$db->query($selectAll);
        
        //Return the results
        self::$db->execute();
        
        //Return the resultSet
        return self::$db->resultSet();       
        
    }
}


?>