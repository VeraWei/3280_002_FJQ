<?php



    class TuitionDAO {
    
        //Constant ClassName
        public const CLASSNAME = "Tuition";

        // Create a member to store the PDO agent
        private static $db;

        // create the init function to start the PDO agent
        static function init() {
           self::$db = new PDOService(self::CLASSNAME);
        }   

        static function getAll() {
            $sql = "SELECT * FROM Tuition";
            self::$db->execute_direct($sql);
            return self::$db->resultSet();
        }



    }


    require("inc/config.inc.php");
    require("inc/dbconfig.inc.php");
    //require("PDOService.class.php");
    require("inc/Utility/PDOService.class.php"); // although the require above also works.
    require("inc/Entity/Tuition.class.php");
    TuitionDAO::init();

    //$sql = "SELECT * FROM Tuition WHERE StudentId = :id";
    //all

    $resultSet = TuitionDAO::getAll();
    foreach($resultSet as $tuition){
        if ($tuition.getTuitionPaid()) {
            echo "\n"."Tuition is paid";
        } else {
            echo "\n"."Tuition is not paid";
        }
    }
        
    

?>