<?php
class SuperPage{
    public static $title = "Class RouteTest";

    public static $style = "css/styles.css";

    public static $author = "Fernando";

    public static $errors = array();

    // Render the contents of this page.
    // Invokes:
    //    onPreHTTP()
    //    onPage()
    //    onPostHTTP()
    static function renderContents() 
    { 
        //Uses late binding to get the implementation of subclasses
        if (static::onPreHTTP()) {
            if ( !(static::onPage() && static::onPostHTTP()) ) {
                //some error may have occurred 
                static::onErrorMessage();
            }
        }
    }

    // Ensure that the user has the required privileges for the application.
    // This is the method for page redirection, not intended to write out html.
    // Returning FALSE from this method prevents onPage() and onPostHTTP() execution.
    static function onPreHTTP() {

	    //if (!static::checkPrivileges()) {
		// %zenPageError = $$$ERROR($$$AccessDenied)
		// %zenStatsTime = $zh
        // %response.Status = "403 Forbidden"
        //}
        return TRUE;
    }


    static function onPage() {
        static::header();
        static::body();
        static::footer();
        return empty(static::$errors);
    }

    static function onPostHTTP() {
        //remove some data from the session for example.
        return TRUE;
    }

    static function header()
    { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title></title>
            <meta charset="utf-8">
            <meta name="author" content="<?php echo static::$author; ?>">
            <title><?php echo static::$title; ?></title>
            <link href="<?php echo static::$style; ?>" rel="stylesheet">
        </head>

        <body>
            <header>
                <h1><?php echo static::$title; ?></h1>
            </header>
            <article class="container">
    <?php }

    static function body() {
        echo "onPage not implemented";
    }

    static function footer()
    { ?>
            </article>
            <div class="footer">
                <p class="pagefooterdiv">
                    <span class="releasetext">Release: 0.0.1</span>
                </p>
                <div class="banner_copyright">
                    <div>© 2020 Course 3280002 Team 1.<br>This software contains confidential and proprietary information of Douglas college or its subsidiaries.<br>Use of this software is limited for study purpose, any other commercial purpose is prohibited.</div>
                </div>
            </div>
        </body>
        </html>
    <?php }


    // This function displays the list of error messages
    function onErrorMessage()  
    { 
        if (is_empty(self::$errors)) return;
        //
        ?>
        <div class="error">
            Please fix the following errors:  
            <ul>
                <?php foreach (self::$errors as $errorDescription){
                echo "<li> - $errorDescription </li>";
                } ?>
            </ul>
        </div>    
    <?php }
    
}

class RouteTestPage extends SuperPage
{

    public static $author = "Fernando Maia (Overridden)";
    
    static function body()
    { ?>
        
        <div>
            <section class="form1">
                <!--<form action="<?php //echo $_SERVER["PHP_SELF"]; ?>" method="post">-->
                <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                <input type="text" value="Some value for input" />    
                <input class="btn-primary" type="submit" value="Login" />
                </form>
            </section>
        </div>

    <?php }

}    


?>