<?php

Class Facility {

    // Make sure to have attributes and get only the fields we need here
    // Save your time :)

    //Attributes
    private $FacilityID;
    private $FacilityName;


    //Getters
    function getId() : int {
        return $this->FacilityID;
    }
    function getName() : string {
        return $this->FacilityName;
    }
    
}

?>