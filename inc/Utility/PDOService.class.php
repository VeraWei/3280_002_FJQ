<?php

// You can thank me later for not asking you to write the following code

class PDOService {

    //Pull in the attributes from the config
    private  $_host = DB_HOST;  
    private  $_port = DB_PORT;
    private  $_user = DB_USER;  
    private  $_pass = DB_PASS;  
    private  $_dbname = DB_NAME;  

    //Store the PDO Object
    private  $_dbh;
    private  $_error;

    //Store the class we will be working with;
    private $_className;

    //Store the Query Statement;
    private $_pstmt;


    //Construct our wrapper, build the DSN
    public function __construct(string $className) {
        
        $this->_className = $className;

        //Assemble the DSN (Data Source Name)
        $dsn = 'mysql:host=' .$this->_host. ';dbname=' .$this->_dbname. ';port='.$this->_port;

        //Set the options for PDO
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
        

        //Try to get a PDO class
        try {
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
        } catch (PDOException $pe)   {
            $this->_error = $pe->getMessage();
            error_log($this->_error);
        }

    }

    //This function prepares, binds dynamically if necessary, and executes a sql statement.
    //References:
    //    Regular Expressions:
    //          https://www.php.net/manual/en/ref.pcre.php
    //    Reflections:
    //          https://www.php.net/manual/en/reflectionmethod.invoke.php
    //
    // $parameters is a dynamic argument which might hold Object references, associative arrays or primitive data type values
    public function execute_direct($queryString, $parameters=null) {
        //prepare
        $this->_pstmt = $this->_dbh->prepare($queryString);

        //bind, in case of query string which includes a placeholder ":variable"
        // If $parameters is an object:
        //      $this->bind(':propertyName',$parameters->get<PropertyName>());
        // If $parameters is an array:
        //      $this->bind(':propertyName',$parameters["propertyName"]);
        // Else $parameters is a primitive datatype:
        //      $this->bind(':propertyName',$parameters);
        //
        $placeHolderPattern = '/\:([a-zA-Z0-9_]+){1}/'; // a placeholder in a sql query string has the following pattern: a colon ':' followed by a group of alphanumeric and/or underscore characters
        $offset = 0; //Starting point of the pattern search
        while (preg_match($placeHolderPattern, $queryString, $matches, PREG_OFFSET_CAPTURE, $offset)){
            $propertyName = $matches[1][0];
            if (gettype($parameters)=='object') { //it is an object instance, then try to use getter method to bind
                //getter method
                $getterMethodName = "get" . ucfirst($propertyName); // ucfirst() converts the first character of a string to Uppercase. Usually this is the recommended convention name for getter methods.
                $reflectionGetPropertyMethod = new ReflectionMethod($this->_className, $getterMethodName);
                //bind to the value of object's getter method
                $this->bind(':'.$propertyName,$reflectionGetPropertyMethod->invoke($parameters));
            } elseif (gettype($parameters)=='array') {
                //bind to the value in the array indexed by the propertyName
                $this->bind(':'.$propertyName,$parameters[$propertyName]);
            } else {
                //presumably is a primitive data type, so bind to the value in $parameters
                $this->bind(':'.$propertyName,$parameters);
            }
            //next search/match is going start after the last colon ':' found
            $offset = $matches[1][1];
        }

        //execute
        return $this->_pstmt->execute();

    }

    //This function prepares a query that has be passed
    public function query(string $query)    {
        $this->_pstmt = $this->_dbh->prepare($query);
    }

    //This function binds parameters
    public function bind($param, $value, $type=null)    {

        if (is_null($type)) {  
            switch (true) {
                //If the value is an integer
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                //If the value is a boolean
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                //If the value is null
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                //If nothing else the value must be a string
                default:  
                $type = PDO::PARAM_STR;  
                break;
                }  
            }
            
        //Finally lets bind the paremter
        $this->_pstmt->bindValue($param, $value, $type);  

    }

    //This function will excute the statement when its ready.
    public function execute()   {
        return $this->_pstmt->execute();
    }

    //This function will return the result of the executed query
    public function resultSet() {
        
        //Return Classes!
        return $this->_pstmt->fetchAll(PDO::FETCH_CLASS, $this->_className);
    }

    //This function will return a single result of the executed Query
    public function singleResult()  {

        //Set the fetch mode
        $this->_pstmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        //Return the result
        return $this->_pstmt->fetch(PDO::FETCH_CLASS);
    }

    //This function returns the rowCount
    public function rowCount()  {
        return $this->_pstmt->rowCount();
    }

    //This function will return the last inserted Id
    public function lastInsertedId()  {
        return $this->_dbh->lastInsertId();
    }

}

?>