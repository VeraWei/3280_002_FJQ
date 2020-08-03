<?php

class Tuition {


    private $StudentID;
    private $AmountOwing;
    private $TuitionPaid;

    //

    //Getters
    function getStudentID() : int{
        return $this->StudentID;
    }
    function getAmountOwing() : string{
        return $this->AmountOwing;
    }
    function getTuitionPaid() : bool{
        return $this->TuitionPaid;
    }
    //Setters
    function setStudentID(int $StudentID){
        $this->StudentID = $StudentID;
    }
    function setAmountOwing(string $AmountOwing){
        $this->AmountOwing = $AmountOwing;
    }
    function setTuitionPaid(bool $TuitionPaid){
        $this->TuitionPaid = $TuitionPaid;
    }
}

?>