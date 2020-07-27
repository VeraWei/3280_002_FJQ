<?php
class SuperPage{
    public static $title = "Class SuperPage";

    public static $style = "css/styles.css";

    public static $author = "Fernando";

    public static $errors = array();

    // Render the contents of this page.
    static function renderContents() 
    { 
        //Use late binding to get the implementation of subclasses
        static::header();
        static::body();
        static::footer();
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
            <?php static::onErrorMessage(); ?>
            <article class="container">
    <?php }

    static function body() {
        echo "onPage not implemented in the subclass";
    }

    static function footer()
    { ?>
            </article>
        </body>
        </html>
    <?php }


    // This function displays the list of error messages
    static function onErrorMessage()  
    { 
        if (empty(self::$errors)) return; //nothing to show
        //
        ?>
        <div class="error">
            Messages:  
            <ul>
                <?php foreach (self::$errors as $errorDescription){
                echo "<li> $errorDescription </li>";
                } ?>
            </ul>
        </div>    
    <?php }
    
}

class RouteTestPage extends SuperPage
{

    public static $author = "Fernando Maia (Overridden)";
    
    public static $title = "this is the RouteTestPage";

    static function body()
    { ?>
        
        <div>
            <section class="form1">
                <h2>test page</h2>
                <!--<form action="<?php //echo $_SERVER["PHP_SELF"]; ?>" method="post">-->
                <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                <input type="text" value="Some value for input" />    
                <input class="btn-primary" type="submit" value="Login" />
                </form>
                <P><br><a href="<?php echo Route::makeURL("test-page",array("action"=>"delete","id"=>1234)) ?>">click here to see an example of delete URI</a>
                </p>
                <br><a href="<?php echo Route::makeURL("test-page","action=update&otherArgument=someValue") ?>">click here to see another example of URI</a>
                
            </section>
        </div>

    <?php }

}    


?>