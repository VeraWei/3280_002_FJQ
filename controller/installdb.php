<?php 

//Check if the environment variables are ok on the server side
if (!(strpos(strtolower(getenv('Path')),"mysql")>0))
{
    InstallDBPage::$errors[] = "System Environment Variable <strong>Path</strong> does not seem to contain MySQL executable path. <br/> eg.: C:\wamp64\bin\mysql\mysql5.7.28\bin. <br/><br/>Consider adding it to Path environment variable, or you could run the the script manually.";
}

if (empty($_POST)) {
    InstallDBPage::renderContents();    
} else {
    // Try to run database script creation, and if everything is ok, then creates file dbconfig.php
    if (isset($_POST["submit"])) 
    {
        installDB();
    } 
    // User opted for manual execution of database script creation, then only creates file dbconfig.php
    if (isset($_POST["submitManual"]))
    {
        writeFileDBConfig();
    }

    if (!empty(InstallDBPage::$errors)) { //fail at running the scipt or creating "inc/dbconfig.inc.php" file.
        InstallDBPage::renderContents();
    } else {
        //Reload page from the client side
        header("Location:".$_SERVER["REQUEST_URI"]);
    }
} 



function installDB(){
    $script_path = "data/sql/CourseReg.sql";
    $command = "cmd /c \"".
                    "mysql ".
                    "--user={$_POST['db_user']} " .
                    "--password={$_POST['db_pass']} " .
                    "--host {$_POST['db_host']} " .
                    "--port {$_POST['db_port']} " .
                    "< {$script_path} " . 
                    "2>&1 \"" ;
                    // 2>&1 to get the messages

    //$command = "cmd /c set > set.txt"; //check the execution context of PHP user.                
        
    //run database script on the server
    exec( $command , $output, $return_var );
    if ($return_var==0) { //success creating database
        writeFileDBConfig();
    } else { //fail creating database
        foreach ($output as $outputLine) {
            error_log($outputLine);
            InstallDBPage::$errors[] = $outputLine;
        }
    }
}

function writeFileDBConfig(){
   try{
        
        $template_file = "data/templates/dbconfig_template.txt"; 
        $dbconfig_include_file = "inc/dbconfig.inc.php";
        $fh = fopen($dbconfig_include_file, "a"); //append mode
        //open file for exclusive write
        flock($fh, LOCK_EX);

        //read the entire string
        $str=file_get_contents($template_file);

        //replace placeholders in in the file string - this is a VERY simple example
        $str=str_replace("#DB_HOST#",$_POST["db_host"] , $str);
        $str=str_replace("#DB_PORT#",$_POST["db_port"] , $str);
        $str=str_replace("#DB_USER#",$_POST["db_user"] , $str);
        $str=str_replace("#DB_PASS#",$_POST["db_pass"] , $str);

        fwrite($fh, $str, strlen($str));
        flock($fh, LOCK_UN);
    }
    catch(Exception $e){
        $error = 'Caught an exception: ' . $e->getMessage() . "\n";
        InstallDBPage::$errors[] = $error;
        error_log($error);
    }
    finally{
        fclose($fh);
    }
    
}



?>