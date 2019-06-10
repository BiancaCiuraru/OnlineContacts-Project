<?php

class GroupsModel{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "test";
    private $conn;

    public function __construct(){
        $this->conn= new mysqli($this->servername, $this->username, $this->password, $this->db);
    }

    public function nameGroupValidity($groupName){
        if(!preg_match("/\A[A-Z][a-z A-Z1-9]*\z/", $groupName)){
            return false;
        }else {
            return true;
        }
    }

    public function getUserID($email){
        $selectStatement = $this->conn -> prepare("select id_user from utilizatori where email = ?");
        $selectStatement -> bind_param("s", $email);
        $selectStatement -> execute();
        $selectStatement -> bind_result($result);
        $selectStatement->fetch();
        return $result;
    }

    //adaugarea unui grup unui utilizator
    public function addGroup($groupName, $description){
        $created_date = date("Y/m/d");
        $id_user = $this-> getUserID($_SESSION['emailLogin']);

        $selectNameGroups = $this->conn -> prepare("select groupName from groups where id_user = ? and groupName = ?"); //verificam unicitatea numelui
        $selectNameGroups -> bind_param("is", $id_user, $groupName);
        $selectNameGroups -> execute();
        $result = $selectNameGroups -> get_result();

        if($result->num_rows>0){
            return false;
        }else{
            $insertStatementContact = $this->conn -> prepare("INSERT INTO groups (groupName, descript, created_date, id_user) VALUES (?, ?, ?, ?)");
            $insertStatementContact -> bind_param("sssi", $groupName, $description, $created_date, $id_user);
            $insertStatementContact -> execute();
            $insertStatementContact -> close();
            return true;
        }
    }

    //listarea grupurilor unui utilizator
    public function listGroup($email){
        
        $id_user = $this-> getUserID($_SESSION['emailLogin']);

        $selectGroups = $this->conn -> prepare("select * from groups where id_user = ?");
        $selectGroups -> bind_param("i", $id_user);
        $selectGroups -> execute();
        $groupsIndex = array();

        $groups = $selectGroups -> get_result();
        $index = 0;
        
        for($i = 1; $i <= $groups->num_rows; $i++){
            $rezultat = $groups->fetch_assoc();
            $groupsIndex[$index] = new Group($rezultat['groupName'], $rezultat['created_date'], $rezultat['descript'], $rezultat['groupName']);
            $index++;
        }    
        return $groupsIndex;
    }

    //vizualizarea detaliilor unui grup
    public function getDescription($email, $groupName){
        $id_user = $this->getUserID($email);

        $selectDetails = $this->conn -> prepare("select descript from groups where id_user = ? and groupName = ?");
        $selectDetails -> bind_param("is", $id_user, $groupName);
        $selectDetails -> execute();
        $selectDetails -> bind_result($resultt);
        $selectDetails->fetch();
        return $resultt;
    }

    public function getGroupName($email, $groupName){
        $id_user = $this->getUserID($email);

        $selectDetails = $this->conn -> prepare("select groupName from groups where id_user = ? and groupName = ?");
        $selectDetails -> bind_param("is", $id_user, $groupName);
        $selectDetails -> execute();
        $selectDetails -> bind_result($resultt);
        $selectDetails->fetch();
        return $resultt;
    }
}

class Group {
    public $nameGroup;
    public $created_date;
    public $description;
    public $groupName;
    function __construct($nameGroup, $created_date, $description, $groupName) {
        $this -> nameGroup = $nameGroup;
        $this -> created_date = $created_date;
        $this -> description = $description;
        $this -> groupName = $groupName;
    }
}

?>