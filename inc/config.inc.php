<?php

if (file_exists("dbconfig.inc.php")) {
    require_once("dbconfig.inc.php");
}
// definition for log file
define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);  
ini_set('error_log', LOGFILE); 
?>