<?php


// this Route class works together with Team1.php
class Route {

    // routes are: array("route-name" . "||" . "HTTP Method").
    // Keep track of routes in use currently. handleRequestsNotDispatched() is going
    private static $validRoutes = array();

    // these routes are not validated against $_SESSION['loggedin']. So requests from not logged users to these rotes will be accepted and dispatched.
    private static $exceptionRoutes =["","Team1.php","Login.php"];

    // 1 $route - Route: whatever comes in the URL after web application path. 
    //      Ex: http://server/appVirtualDirectory/Team1.php where "Team1.php" is the $_GET["route"] , or;
    //          http://server/appVirtualDirectory/any-desired-string where "any-desired-string" is the $_GET["route"] ), or;
    //          http://server/appVirtualDirectory/order/items where "order/items" is the $_GET["route"] ; or
    //          http://server/appVirtualDirectory/order/items?id=333 where "order/items" is the $_GET["route"]  and $_GET["id"] = 333, will be also available; See .htaccess file.
    //
    // 2 $function - Function which should be invoked when the client side requests this method and route. Anonymous functions.     
    // 3 $method (optional) - HTTP Method (POST,GET,etc...). If present, then it validates.  Once using routes that are method specific, every request for this route should include a $method, otherwise it can be processed twice.
    static function dispatchRequest($route,$function,$method=null){
        //Default is accept all HTTP methods when not specified.
        $HTTPMethod = isset($method) ? $method : $_SERVER["REQUEST_METHOD"];
        
        //Add this route to the control
        self::$validRoutes[] = self::getRouteId($route,$HTTPMethod) ;
        
        // Invoke $function reference when HTTP requested (POST,GET,DELETE,etc...) 
        if ($_SERVER["REQUEST_METHOD"] == $HTTPMethod )
        {
            if ( $route == $_GET["route"] )  
            {
                error_log("Route invoked" . self::getRouteId($route,$HTTPMethod));
                self::checkPrivileges(); // In case of user not logged in, redirects to the main page and exit.
                $function->__invoke(); //Invoke this anonymous function
            } 
        }
    } 

    static function getRouteId($route,$method){
       return  $route . "||" . $method; 
    }

    //This function MUST be called at the end of Routes in the main controller Page1.php
    static function onRequestNotDispatched(){

        $routeId = self::getRouteId($_GET["route"],$_SERVER["REQUEST_METHOD"]);

        if ( ! in_array($routeId,self::$validRoutes) ){
            header('HTTP/1.0 404 Not Found');
            if (!file_exists('inc/dbconfig.inc.php')) {
                echo "'inc/dbconfig.inc.php' is missing on the server. Go to the main page Team1.php to create it.";
            } else {
                echo "Method: ".$_SERVER["REQUEST_METHOD"]."\n<br>";
                echo "Route: " . $_GET["route"] . "\n<br>";
                echo "\n<br>NOT SET FOR DISPATCH\n<br>";  
            }
        }  
    }

    static function checkPrivileges(){
        if ( in_array($_GET["route"],self::$exceptionRoutes)){
            return ; //there is nothing to check for the exceptions
        }

        //Start the session
        session_start();
        //check for the loggedin entry in the $_SESSION
        $userId = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : 0;
        if ($userId==0) {
            header("Location: Team1.php" ); //Redirects on the client side, to the starting page
            exit;
        }
    }
}
?>