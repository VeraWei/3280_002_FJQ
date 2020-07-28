<?php 


class InstallDBController {

    static function onGet(){
        InstallDBPage::renderContents();
    }

    static function onPost()
    {
        //adm user asked for running the database creation script
        if (isset($_POST["submit"])) 
        {
            self::installDB();
        } 
        // User opted for manual execution of database script creation, then only creates file dbconfig.php
        if (isset($_POST["submitManual"]))
        {
            self::writeFileDBConfig();
        }

        if (!empty(InstallDBPage::$errors)) { //fail at running either, db scipt or creating "inc/dbconfig.inc.php" file.
            InstallDBPage::renderContents();
        } else {
            //header("Location:install-db-is-ok");
            header("Location:Team1.php");
        }
    }

    static function installDB(){
        $script_path = "data/sql/CourseReg.sql";
        $mysql_exe = self::getMySQLInstallationDirectory();
        if ($mysql_exe!=""){
            $mysql_exe .= "\\bin\\";
        }
        $mysql_exe .= "mysql";
    
        $command = "cmd /c \"" .
                        $mysql_exe . " " .
                        "--user={$_POST['db_user']} " .
                        "--password={$_POST['db_pass']} " .
                        "--host {$_POST['db_host']} " .
                        "--port {$_POST['db_port']} " .
                        "< {$script_path} " . 
                        "2>&1 \"" ;
                        // 2>&1 to get the messages    
        //run database script on the server
        exec( $command , $output, $return_var );
        if ($return_var==127 || $return_var==0) { //success creating database
            self::writeFileDBConfig();
        } else { //fail creating database
            foreach ($output as $outputLine) {
                error_log($outputLine);
                InstallDBPage::$errors[] = $outputLine;
            }
        }
    }
    
    static function writeFileDBConfig(){
       try{
            
            $template_file = "data/templates/dbconfig_template.txt"; 
            $dbconfig_include_file = "inc/dbconfig.inc.php";
            $fh = fopen($dbconfig_include_file, "a"); //append mode
            //open file for exclusive write
            flock($fh, LOCK_EX);
    
            //read the entire string
            $str=file_get_contents($template_file);
    
            //replace placeholders in the file string
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
    
    //Try to connect to database and get the installation directory of MySQL, so we can run database creation script.
    static function getMySQLInstallationDirectory() {    
        try {
            $dsn='mysql:host=' .$_POST["db_host"]. ';port='.$_POST["db_port"];
            $db = new PDO($dsn, $_POST['db_user'], $_POST['db_pass']);
            $result = $db->query("select @@basedir as mysqlDir")->fetch()["mysqlDir"];
        } catch (PDOException $pe)   {
            $msg = $pe->getMessage();
            InstallDBPage::$errors[] = $msg;
            error_log($msg);
            $result = "";
        }
        return $result;
    }
}
    
?>