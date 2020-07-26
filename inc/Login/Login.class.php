<?php

Class Login {

    // Make sure to have attributes and get only the fields we need here

    //Attributes
    private $UserID;
    private $PIN;


    //Getters
    function getUserId() : int {
        return $this->UserID;
    }
    function getPIN() : string {
        return $this->PIN;
    }
    
}

?>