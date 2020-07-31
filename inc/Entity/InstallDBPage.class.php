<?php

class InstallDBPage extends SuperPage
{

    public static $author = "Fernando Maia";
    
    public static $title = "Database Setup";

    public static $style = "css/installdb.css";
    
    static function body()
    { ?>
        <div class="container">  
            <form id="dbsettings" method="post">
                <h3><?php echo static::$title; ?></h3>
                
                <h4>Before submission, please ensure mysql command line utility is aavailable on the server.</h4>
                <fieldset>
                <legend>Host:</legend>
                <input type="text" name="db_host" tabindex="1" placeholder="MySQL Host IP/DNS" value="localhost" required >
                </fieldset>
                <fieldset>
                <legend>Port:</legend>
                <input type="text" name="db_port" tabindex="2" placeholder="MySQL Port" autofocus required >
                </fieldset>
                <fieldset>
                <legend>Username:</legend>
                <input type="text" name="db_user" tabindex="3" placeholder="MySQL username" value="root" required >
                </fieldset>
                <fieldset>
                <legend>Password:</legend>
                <input type="password" name="db_pass" tabindex="4" placeholder="Password (optional)" >
                </fieldset>
                <fieldset>
                <p class="warning"><strong>*</strong> By submitting this, you agree to create a database called <strong>registrar</strong> on your DBMS (MySQL).</p>
                <button name="submit" type="submit" data-submit="...Sending"><strong>*</strong>Run Database Script</button>
                </fieldset>
                <!--
                <fieldset>
                <p class="warning"><strong>**</strong> Create "inc/dbconfig.php" only and not try to run command line MySQL script.</p>
                <button name="submitManual" type="submit" data-submit="...Sending"><strong>**</strong> I will run database Script manually.</button>
                </fieldset>
                -->
            </form>
        </div>
    <?php }

}    

?>