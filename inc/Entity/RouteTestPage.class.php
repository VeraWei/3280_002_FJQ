<?php

class RouteTestPage extends SuperPage
{

    public static $author = "Fernando Maia (Overridden)";
    
    public static $title = "this is the RouteTestPage";

    static function body()
    { ?>
        
        <div>
            <section class="form1">
                <h2>test page</h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type="text" value="Some value for input" />    
                <input class="btn-primary" type="submit" value="Login" />
                </form>
                <P><br><a href="test-page?delete=1234">click here to see an example of delete URI</a>
                </p>
                <br><a href="test-page?action=update&otherArgument=someValue">click here to see another example of URI</a>
                
            </section>
        </div>

    <?php }

}    


?>