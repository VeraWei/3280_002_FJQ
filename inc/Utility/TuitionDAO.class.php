<?php

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
  

?>