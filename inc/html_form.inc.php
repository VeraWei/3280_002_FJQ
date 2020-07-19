<?php
 
// simple validation
function validateForm($id, $pwd)    {
    
    if ((strlen($id) != 9) && !ctype_digit($id)) {
        return "Please input your student id correctly!";
    }
    
    if (!$pwd) {
        return "Please input your password correctly!";
    }
    
    return "pass";

}