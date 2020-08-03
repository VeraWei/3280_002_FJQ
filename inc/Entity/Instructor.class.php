<?php 
class Instructor {

    
    private $InstructorID;
    private $InstructorName;
    private $Phone;
    private $Email;
    

    function setInstructorID($id){
        $this->InstructorID = $id;
    }
    function setInstructorName($instructorName){
        $this->InstructorName = $instructorName;
    }
    function setPhone($phone){
        $this->Phone = $phone;
    }
    function setEmail($email){
        $this->Email = $email;
    }

    function getInstructorID() : int{
        return $this->InstructorID;
    }
    function getInstructorName() : string{
        return $this->InstructorName;
    }
    function getPhone() : string{
        return $this->Phone;
    }
    function getEmail() : string{
        return $this->Email;
    }



}
?>