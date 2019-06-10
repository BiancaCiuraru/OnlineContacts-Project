<?php
    class LoginRegisterModel{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "test";
    private $conn;

    public function __construct(){
        $this->conn= new mysqli($this->servername, $this->username, $this->password, $this->db);
    }

    function login($emailLogin, $password) {
        $hashedPassword = md5($password);
        $loginStmt = $this->conn -> prepare('SELECT * FROM utilizatori WHERE email = ? AND pass = ?');
        $loginStmt -> bind_param('ss', $emailLogin, $hashedPassword);
        $loginStmt -> execute();
        $results = $loginStmt -> get_result();
        $loginStmt -> close();
        if($results -> num_rows  === 1) {
            $firstRow = $results -> fetch_assoc();
            return new User($firstRow['email'], $firstRow['pass']);
        } 
        return NULL;
    }

    function getLoggedUser($emailLogin, $hashedPassword) {
        $loginStmt = $this->conn -> prepare('SELECT * FROM utilizatori WHERE email = ? AND pass = ?');
        $loginStmt -> bind_param('ss', $emailLogin, $hashedPassword);
        $loginStmt -> execute();
        $results = $loginStmt -> get_result();
        $loginStmt -> close();
        if($results -> num_rows  === 1) {
            $firstRow = $results -> fetch_assoc();
            return new User($firstRow['email'], $firstRow['pass']);
        } 
        return NULL;
    }

    function emailValidity($email){
        $selectStatement = $this->conn -> prepare("select email from utilizatori where email = ?");
        $selectStatement -> bind_param("s", $email);
        $selectStatement -> execute();
        $result = $selectStatement -> get_result();

        $rez = $result->num_rows;
        return $rez;
    }

    function nameValidity($Fname, $Lname){
        if(!preg_match("/\A[A-Z][a-z]*\z/", $Fname) || !preg_match("/\A[A-Z][a-z]*\z/", $Lname)){
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
        $hashedPassword1 = md5($password1);
        $hashedPassword2 = md5($password2);
        
        $insertStatement = $this->conn -> prepare("INSERT INTO utilizatori (firstName, lName, email, pass) VALUES(?, ?, ?, ?)");
        $insertStatement -> bind_param("ssss", $Fname, $Lname, $email, $hashedPassword1);
        $insertStatement -> execute();
        $insertStatement -> close();
        return true;
    }
}

    class User {
        public $emailLogin;
        public $hashedPassword;
        function __construct($emailLogin, $hashedPassword) {
            $this -> emailLogin = $emailLogin;
            $this -> hashedPassword = $hashedPassword;
        }
    }

?>