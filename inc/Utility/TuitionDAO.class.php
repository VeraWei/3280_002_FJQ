<?php

/*
+-------------+---------+------+-----+---------+-------+
| Field       | Type    | Null | Key | Default | Extra |
+-------------+---------+------+-----+---------+-------+
| StudentID   | int(11) | NO   | PRI | NULL    |       |
| AmountOwing | int(11) | YES  |     | NULL    |       |
| TuitionPaid | bit(1)  | YES  |     | NULL    |       |
+-------------+---------+------+-----+---------+-------+
*/

    class TuitionDAO {
    
        //Constant ClassName
        public const CLASSNAME = "Tuition";

        // Create a member to store the PDO agent
        private static $db;

        // create the init function to start the PDO agent
        static function initialize() {
           self::$db = new PDOService(self::CLASSNAME);
        }   

        static function getAll() {
            $sql = "SELECT * FROM Tuition";
            self::$db->execute_direct($sql);
            return self::$db->resultSet();
        }

        static function getTuition($StudentID) {
            $sql = "SELECT * FROM Tuition WHERE StudentID = :StudentID ";
            self::$db->execute_direct($sql,$StudentID);
            return self::$db->singleResult();
        }

        static function updateTuition($Studentid,$amountOwing) {
            $args = ["amountOwing" => $amountOwing, "StudentID"=>$Studentid];
            $sql = "UPDATE Tuition Set AmountOwing = AmountOwing + :amountOwing WHERE StudentID = :StudentID ";
            self::$db->execute_direct($sql,$args);
            return self::$db->lastInsertedId();
            }


    }


    //require("inc/config.inc.php");
    //require("inc/dbconfig.inc.php");
    //require("PDOService.class.php");
    //require("inc/Utility/PDOService.class.php"); // although the require above also works.
    //require("inc/Entity/Tuition.class.php");

    //TuitionDAO::init();
    /*
    $resultSet = TuitionDAO::getAll();
    foreach($resultSet as $tuition){
        if ($tuition.getTuitionPaid()) {
            echo "\n"."Tuition is paid";
        } else {
            echo "\n"."Tuition is not paid";
        }
    }
    */
    //var_dump(TuitionDAO::getTuition(300000001));    
    

?>