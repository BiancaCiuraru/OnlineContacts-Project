<?php
    class Register_Model extends Model{

    public function __construct(){
        parent::__construct();
    }

    function login($emailLogin, $password) {
        $hashedPassword = md5($password);
        $loginStmt = $this->db -> prepare('SELECT * FROM utilizatori WHERE email = ? AND pass = ?');
        $loginStmt -> bindParam(1, $emailLogin, PDO::PARAM_STR);
        $loginStmt -> bindParam(2, $hashedPassword, PDO::PARAM_STR);
        $loginStmt -> execute();
        if($loginStmt -> rowCount()  === 1) {
            $firstRow = $loginStmt -> fetch();
            return new User($firstRow['email'], $firstRow['pass']);
        } 
        return NULL;
    }
  
    function getID($user){
        $statement = $this->db->prepare('SELECT id_user FROM utilizatori WHERE email = ?');
        $statement->bindParam(1, $user -> emailLogin, PDO::PARAM_STR);
        $statement->execute();
        $inregistrare = $statement->fetch();
        return $inregistrare['id_user'];
    }

    function getLoggedUser($emailLogin, $hashedPassword) {
        $loginStmt = $this->db -> prepare('SELECT * FROM utilizatori WHERE email = ? AND pass = ?');
        $loginStmt -> bindParam(1, $emailLogin, PDO::PARAM_STR);
        $loginStmt -> bindParam(2, $hashedPassword, PDO::PARAM_STR);
        $loginStmt -> execute();
        // $results = $loginStmt -> get_result();
        // $loginStmt -> close();
        if($loginStmt -> rowCount()  === 1) {
            $firstRow = $loginStmt -> fetch();
            return new User($firstRow['email'], $firstRow['pass']);
        } 
        return NULL;
    }

    function emailValidity($email){
        $selectStatement = $this->db -> prepare("select email from utilizatori where email = ?");
        $selectStatement -> bindParam("s", $email);
        $selectStatement -> execute(array($email));

        $rez = $selectStatement->rowCount();
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
        
        $insertStatement = $this->db -> prepare("INSERT INTO utilizatori (firstName, lName, email, pass) VALUES(?, ?, ?, ?)");
        $insertStatement -> bindParam(1, $Fname, PDO::PARAM_STR);
        $insertStatement -> bindParam(2, $Lname, PDO::PARAM_STR);
        $insertStatement -> bindParam(3, $email, PDO::PARAM_STR);
        $insertStatement -> bindParam(4, $hashedPassword1, PDO::PARAM_STR);
        $insertStatement -> execute(array($Fname,$Lname,$email,$hashedPassword1));
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