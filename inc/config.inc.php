<?php

// Define configuration  
define("DB_HOST", "127.0.0.1");  
define("DB_PORT", "3308");  
define("DB_USER", "root");  
define("DB_PASS", "");  
define("DB_NAME", "Registrar");  

// definition for log file
define('LOGFILE','log/error_log.txt');
  
// set the php ini file to log the error to the LOGFILE
// log_errors -> Tells whether script error messages should be logged to the server's error log or error_log. 
ini_set("log_errors", TRUE);  
// error_log -> filename where script errors must be logged to. function error_log().
ini_set('error_log', LOGFILE); 
?>