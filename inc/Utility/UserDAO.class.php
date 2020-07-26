<?php

class UserDAO   {

    // Create a member to store the PDO agent
    private static $db;
    // create the init function to start the PDO agent
    static function init() {
        self::$db = new PDOAgent("User");
    }

    
  
    // function to create user
    static function createUser(User $user){
        // make sure the strings being stored in the database are cleaned 
        // trimmed, and changed to lowercase
        $insertSQL = "INSERT INTO users VALUES(NULL, :first_name, :last_name, :username, :email, :color, :age, :password);";
        // query
        self::$db->query($insertSQL);
        // bind
        self::$db->bind(':first_name',$user->getFirstName());
        self::$db->bind(':last_name',$user->getLastName());
        self::$db->bind(':username', $user->getUserName());
        self::$db->bind(':email',$user->getEmail());
        self::$db->bind(':color',$user->getColor());
        self::$db->bind(':age', $user->getAge());
        self::$db->bind(':password', $user->getPassword());

        // execute
        self::$db->execute();
        // you may return the rowCount
        return self::$db->rowCount();


    }

    // get a user detail
    static function getUser(string $userName)  {
        // you know the drill
        $sql = "SELECT * FROM users WHERE username=:user";
        self::$db->query($sql);
        self::$db->bind(":user",$userName);
        self::$db->execute();
        
        return self::$db->singleResult();

    }



    // get multiple users detail
    // It is not needed in our app, but hey.. more practice is better!
    static function getUsers()  {
        //you know the drill
        $sql = "SELECT * FROM users;";
        self::$db->query($sql);
        self::$db->execute();
        
        return self::$db->getResultSet();
    }
    
    
}

?>