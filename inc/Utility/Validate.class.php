<?php

class Validate{
    // Please use filter to validate the inputs whenever possible
    // Please also sanitize the inputs.    
    
    // Up to you how to create the function(s) to validate the inputs    
    static function validateInputs() : array{
        $errorsArray = array(); // initiating errors array to store errors
        $firstName;
        $lastName;
        $email;
        $color;
        $age;
        $username;
        $password;
    // What to validate?
    // First Name and Last Name should not be empty and not numbers
    if(!empty($_POST['firstname'])) {
        
          $numberInName = false; //This is a for loop that checks if a number exists in the first name through strpos() method
          for($i = 0; $i <= 9; $i++){
              if(strpos($i, $_POST['firstname']))
                  $numberInName = true;
          }
        if (!$numberInName) //If there is no number in the first name
        // Also replace occurences of semicolon, colon, comma, ampersand, 
        // dollar sign, < and > and any improper character with nothing
            $firstName = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING));
        
        else 
            array_push($errorsArray, "You can't have numbers in your name"); //adding errors
    } 
    else
        array_push($errorsArray, 'First Name field is empty');
    
    if(!empty($_POST['lastname'])){ //This is a for loop that checks if a number exists in the last name through strpos() method
        $numberInName = false;
        for($i = 0; $i <= 9; $i++){
            if(strpos($i, $_POST['lastname']))
                $numberInName = true;
        }
        if(!$numberInName) //If there is no number in the last name
            $lastName = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING));
        else 
            array_push($errorsArray, "You can't have numbers in your name");
    }
        
    else 
        array_push($errorsArray, 'Last Name field is empty');

    // Email should be email format
    if(!empty($_POST['email'])) {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            $email = trim(filter_var(FILTER_SANITIZE_EMAIL));
        else
            array_push($errorsArray, "Email is in invalid format");
    }
    else
        array_push($errorsArray, 'Email field is empty');

    // One of the color must be chosen. The first option is not a valid entry
    if(!empty($_POST['color'])) {
        if(in_array($_POST['color'], ['Red', 'Green', 'Blue']))
            $color = trim(filter_var($_POST['color'], FILTER_SANITIZE_STRING));
        else
            array_push($errorsArray, "Color is invalid");
    }
    else
        array_push($errorsArray, "Color has not been selected");
    // Age must be in number between 15 to 100
    if(!empty($_POST['age'])){
        if(filter_var($_POST['age'], FILTER_VALIDATE_INT)){
            if($_POST['age'] >= 15 && $_POST['age'] <= 100)
                $age = trim(filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT));
            else
                array_push($errorsArray, "Age must be between 15 and 100");
        }
        else
            array_push($errorsArray, "invalid age");
    }
        else
            array_push($errorsArray, "age field is empty");
    // username must be in one word. it can be combination of character and number
    if(!empty($_POST['username'])){
        if(!strpos($_POST['username'], ' ')) 
            $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        else
            array_push($errorsArray, "Username can not contain spaces");
    }
    else
        array_push($errorsArray, "Username field is empty");
    // password
        // let's have a 6 digits string as password
        // both password and password confirm needs to be the same
    if(!empty($_POST['password'])) {
        if (filter_var($_POST['password'], FILTER_VALIDATE_INT)) {
            if(strlen($_POST['password']) == 6) {
                if($_POST['password'] == $_POST['passwordconfirm'])
                    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_NUMBER_INT));
                else
                    array_push($errorsArray, "password and password confirmation don't match");
            }
            else 
                array_push($errorsArray, "password must contain 6 digits");
        }
        else
           array_push($errorsArray, "password has to be a 6 digit number");
    }
    else
        array_push($errorsArray, "Password field is empty");

    if(sizeof($errorsArray) != 0) {
        $errorlist = '<ul style="color:red">';
        foreach ($errorsArray as $error) {
            $errorlist .= '<li><strong>'.$error.'</strong></li>';
        }
        $errorlist .= '</ul>';
        throw new Exception($errorlist);
    }
    return array($firstName, $lastName, $email, $color, $age, $username, $password);
    }

    //This is a sanitation function for the login form
    static function validateLoginInputs() : array {
        $username = trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_NUMBER_INT));
        return array($username, $password);
    }

}

?>