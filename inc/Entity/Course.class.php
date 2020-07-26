<?php

class Course {
//Properties
private $CRN;
private $Credits;
private $Subject;
private $Title;
private $InstructorID;
private $PreReq;
private $Duration;
private $Enrl;
private $Rem;
private $Wait;

 //Setters
 function setCRN($crn){
     $this->CRN = $crn;
 }
 function setCredits($credits){
     $this->Credits = $credits;
 }
 function setSubject($subject){
     $this->Subject = $subject;
 }
 function setTitle($title){
     $this->Title = $title;
 }
 function setInstructorID($instructorid){
     $this->InstructorID = $instructorid;
 }
 function setPreReq($prereq){
     $this->PreReq = $prereq;
 }
 function setDuration($duration){
     $this->Duration = $duration;
 }
 function setEnrl($enrl){
     $this->Enrl = $enrl;
 }
 function setRem($rem){
     $this->Rem = $rem;
 }
 function setWait($wait){
     $this->Wait = $wait;
 }
 //Getters
 function getCRN() : int {
     return $this->CRN;
 }
 function getCredits() : string {
     return $this->Credits;
 }
 function getSubject() : string {
     return $this->Subject;
 }
 function getInstructorID() : string{
    return $this->InstructorID;
 }
 function getPreReq(){
     return $this->PreReq;
 }
 function getDuratoin(){
     return $this->Duration;
 }
 function getEnrl(){
     return $this->Enrl;
 }
 function getRem(){
     return $this->Rem;
 }
 function getWait(){
     return $this->Wait;
 }

 //Verify the password
 function verifyPassword(string $passwordToVerify) {
     //Return a boolean based on verifying if the password given is correct for the current user
     return password_verify($passwordToVerify, $this->password);
 }
    
}

?>