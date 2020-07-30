<?php

class SuperPage{
    public static $title = "Class SuperPage";

    public static $style = "css/styles.css";

    public static $author = "Fernando";

    public static $errors = array();

    public static $messages = array();

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
            <?php static::onMessage(); ?>
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


    // This function displays the list of messages
    static function onMessage()  
    { 
        if (!empty(self::$errors)) { ?>
            <div class="error">
                Errors:  
                <ul>
                    <?php 
                    foreach (self::$errors as $errorDescription){
                        echo "<li> $errorDescription </li>";
                    } 
                    ?>
                </ul>
            </div>    
        <?php }
       if (!empty(self::$messages)) { ?>
            <div class="message">
                Messages:  
                <ul>
                    <?php 
                    foreach (self::$messages as $message){
                        echo "<li> $message </li>";
                    } 
                    ?>
                </ul>
            </div>    
        <?php }

    }

        
    
}

?>