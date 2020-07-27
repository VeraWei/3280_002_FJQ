<?php

Class User {

    // Make sure to have attributes and get only the fields we need here

    //Attributes
    private $StudentID;
    private $Password;


    //Getters
    function getStudentID() : int {
        return $this->StudentID;
    }
    
    function getPassword(): string {
        return password_hash($this->Password, PASSWORD_DEFAULT);
    }
    
    //Verify the password
    function verifyPassword(string $passwordToVerify) {
        //Return a boolean based on verifying if the password given is correct for the current user
        return password_verify($passwordToVerify, $this->Password);
    }
}

?>