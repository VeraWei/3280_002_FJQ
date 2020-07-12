<?php

class Reservation {

    // We need all columns except the venue!

    // Attributes, make sure they match the column names!

    // ReservationID	 Name	Email	FacilityID ReservationDate Length
  
    private $ReservationID;
    private $Name;
    private $Email;
    private $FacilityID;
    private $FacilityName;
    private $ReservationDate;
    private $Length;

    //Setters
    function setName(string $name){
        $this->Name = $name;
    }
    function setEmail(string $email){
        $this->Email = $email;
    }
    function setFacilityID(int $facilityID){
        $this->FacilityID = $facilityID;
    }
    function setReservationDate($reservationDate){
        $this->ReservationDate = $reservationDate;
    }
    function setLength(int $length){
        $this->Length = $length;
    }
    
    //Getters
    function getReservationID() : string{
        return $this->ReservationID;
    }

    function getName() : string{
        return $this->Name;
    }
    function getEmail() : string{
        return $this->Email;
    }
    function getFacilityID() : int{
        return $this->FacilityID;
    }
    function getFacilityName(){
        return $this->FacilityName;
    }
    function getReservationDate(){
        return $this->ReservationDate;
    }
    function getLength() : int{
        return $this->Length;
    }


}