<?php
    
    $CONFIG = [
        'servername' => "localhost",
        'username' => "root",
        'password' => '',
        'db' => 'test'
    ];
    
    $conn = new mysqli($CONFIG["servername"], $CONFIG["username"], $CONFIG["password"], $CONFIG["db"]);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function emailValidity($email){
        GLOBAL $conn;
        $selectStatement = $conn -> prepare("select email from utilizatori where email = ?");
        $selectStatement -> bind_param("s", $email);
        $selectStatement -> execute();
        $result = $selectStatement -> get_result();

        $rez = $result->num_rows;
        return $rez;
    }

    function nameValidity($Fname, $Lname){
        if(!preg_match("/^[A-Z]+[a-zA-Z]*$/", $Fname) || !preg_match("/^[A-Z]+[a-zA-Z]*$/", $Lname)){
            return false;
        }else {
            return true;
        }
    }

    function passwordValidity($password1, $password2){
        if( $password1 !== $password2){
            return false;
        }else {
            return true;
        }
    }

    function passwordRules($password1, $password2){
        if(strlen($password1)<=5 || !preg_match("/^[a-zA-Z]*[^a-zA-Z]+[a-zA-Z]*$/", $password1, $matches)){
            return false;
        }else{
            foreach($matches as $match){
                if($match === $password1)
                {
                    return true;
                }
            }
            
        }
        if(strlen($password2)<=5 || !preg_match("/^[a-zA-Z]*[^a-zA-Z]+[a-zA-Z]*$/", $password2, $matches)){
            return false;
        }else{
            foreach($matches as $match){
                if($match === $password2)
                {
                    return true;
                }
            }
            
        }
    }

    function register($Fname, $Lname, $email, $password1, $password2) {
        GLOBAL $conn;

        $hashedPassword1 = md5($password1);
        $hashedPassword2 = md5($password2);
        
        $insertStatement = $conn -> prepare("INSERT INTO utilizatori (firstName, lName, email, pass) VALUES(?, ?, ?, ?)");
        $insertStatement -> bind_param("ssss", $Fname, $Lname, $email, $hashedPassword1);
        $insertStatement -> execute();
        $insertStatement -> close();
        return true;
    }

?>