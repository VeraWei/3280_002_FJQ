<?php

class Route {

    // routes are: array("HTTP Method" =>  "route-name").
    public static $validRoutes = array();

    public static function set($method,$route,$function){
        //Add route
        $HTTPVerb = strtoupper($method);
        self::$validRoutes[] = array($HTTPVerb => $route) ;
        
        // Invoke $function reference when HTTP requested (POST or GET) 
        if ($_SERVER["REQUEST_METHOD"] == $HTTPVerb ) {

            $routeRequested = isset($_GET["route"]) ? $_GET["route"] : "";
            
            if ( ( $route == $routeRequested ) ) {
                self::checkPrivileges(); // In case of user not logged in, redirects to the main page and exit.
                $function->__invoke(); //Invoke this actual code in this function's reference
            } 
        }
    } 

    public static function handleRequestsNotDispatched(){

        $route = isset($_GET["route"]) ? $_GET["route"] : "";
       
        $routeArrayElement = array($_SERVER["REQUEST_METHOD"] => $route);

        if ( ! in_array($routeArrayElement,self::$validRoutes,TRUE) ){
            header('HTTP/1.0 404 Not Found');
            echo "Method: ".$_SERVER["REQUEST_METHOD"]."\n<br>";
            echo "Route: '$route'\n<br>";
            echo "\n<br>NOT SET FOR DISPATCH\n<br>";
        }  
    }

    //generate an URL for the application
    //TODO: apply URL escape here if needed 
    public static function makeURL($route="",$urlParameters=null) : String {
        
        $urlQueryString = "";
            
        if (gettype($urlParameters)=='array') {
            foreach ($urlParameters as $paramKey => $paramValue) {
                $urlQueryString .= "&" . $paramKey . "=" . $paramValue;
            }
        } else {
            //should be a string
            if ($urlParameters!="") {
                $urlQueryString = "&" . $urlParameters;
            }
            
        }
        return "Team1.php?route=".$route.$urlQueryString;
    }

    public static function checkPrivileges(){
        
        if ($route==""){
            return; //there is nothing to check at starting page
        }

        //Start the session
        session_start();
        //check for the loggedin entry in the $_SESSION
        $userId = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : 0;
        if ($userId==0) {
            header("Location: " . self::makeURL()); //Redirects on the client side, to the starting page
            exit;
        }
    }
}
?>