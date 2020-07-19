<?php

Class Login {

    // Make sure to have attributes and get only the fields we need here

    //Attributes
    private $StudentID;
    private $Password;


    //Getters
    function getStudentID() : int {
        return $this->StudentID;
    }
    function getPassword() : string {
        return $this->Password;
    }
    
}

?>