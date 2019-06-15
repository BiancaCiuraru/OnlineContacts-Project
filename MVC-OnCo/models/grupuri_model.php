<?php

class Grupuri_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function nameGroupValidity($groupName){
        if(!preg_match("/\A[A-Z][a-z A-Z1-9]*\z/", $groupName)){
            return false;
        }else {
            return true;
        }
    }

    public function getUserID($email){
        $selectStatement = $this->db -> prepare("SELECT id_user from utilizatori where email = ?");
        $selectStatement -> bindParam(1, $email, PDO::PARAM_STR);
        $selectStatement -> execute();
        $result = $selectStatement -> fetch();
        return $result['id_user'];
    }

    //adaugarea unui grup unui utilizator
    public function addGroup($groupName, $description){
        $created_date = date("Y/m/d");
        $id_user = $this-> getUserID($_SESSION['emailLogin']);

        $selectNameGroups = $this->db -> prepare("select groupName from groups where id_user = ? and groupName = ?"); //verificam unicitatea numelui
        $selectNameGroups -> bindParam(1, $id_user, PDO::PARAM_INT);
        $selectNameGroups -> bindParam(2, $groupName, PDO::PARAM_STR);
        $selectNameGroups -> execute();

        if($selectNameGroups->rowCount()>0){
            return false;
        }else{
            $insertStatementContact = $this->db -> prepare("INSERT INTO groups (groupName, descript, created_date, id_user) VALUES (?, ?, ?, ?)");
            $insertStatementContact -> bindParam(1, $groupName, PDO::PARAM_STR);
            $insertStatementContact -> bindParam(2, $description, PDO::PARAM_STR);
            $insertStatementContact -> bindParam(3, $created_date, PDO::PARAM_STR);
            $insertStatementContact -> bindParam(4, $id_user, PDO::PARAM_INT);
            $insertStatementContact -> execute();
            return true;
        }
    }

    //listarea grupurilor unui utilizator
    public function listGroup(){
        $id_user = $this-> getUserID($_SESSION['emailLogin']);

        $selectGroups = $this->db -> prepare("select * from groups where id_user = ?");
        $selectGroups -> bindParam(1, $id_user, PDO::PARAM_INT);
        $selectGroups -> execute();
        $groupsIndex = array();
        $index = 0;
        
        for($i = 1; $i <= $selectGroups->rowCount(); $i++){
            $rezultat = $selectGroups->fetch();
            $groupsIndex[$index] = new Group($rezultat['groupName'], $rezultat['created_date'], $rezultat['descript'], $rezultat['groupName']);
            $index++;
        }    
        return $groupsIndex;
    }

    //vizualizarea detaliilor unui grup
    public function getDescription($email, $groupName){
        $id_user = $this->getUserID($email);

        $selectDetails = $this->db -> prepare("select descript from groups where id_user = ? and groupName = ?");
        $selectDetails -> bindParam(1, $id_user, PDO::PARAM_INT);
        $selectDetails -> bindParam(2, $groupName, PDO::PARAM_STR);
        $selectDetails -> execute();
        return $selectDetails;
    }

    public function getGroupName($email, $groupName){
        $id_user = $this->getUserID($email);

        $selectDetails = $this->db -> prepare("select groupName from groups where id_user = ? and groupName = ?");
        $selectDetails -> bindParam(1, $id_user, PDO::PARAM_INT);
        $selectDetails -> bindParam(2, $groupName, PDO::PARAM_STR);
        $selectDetails -> execute();
        return $selectDetails;
    }

    public function getContacts($email, $groupName){
        $id_user = $this->getUserID($email);

        $selectList = $this->db -> prepare("select id_group from groups where id_user = ? and groupName = ?");
        $selectList -> bindParam(1, $id_user, PDO::PARAM_INT);
        $selectList -> binrParam(2, $groupName, PDO::PARAM_STR);
        $selectList -> execute();
        $listRow = $selectList -> fetch();
        $id_g = $listRow['id_group'];

        $selectIdGroup = $this->db -> prepare("select id_contact from member where id_group = ?");
        $selectIdGroup -> bindParam(1, $id_g, PDO::PARAM_INT);
        $selectIdGroup -> execute();
        $contactsList = array();
        $index=0;
        for($j=1; $j <= $selectIdGroup->rowCount(); $j++){
            $listId = $selectIdGroup -> fetch();
            $id_c_m = $listId['id_contact'];

            $selectIdContact = $this->db -> prepare("select fName, lName, email from contact c where id_contact = ?");
            $selectIdContact -> bindParam(1, $id_c_m, PDO::PARAM_INT);
            $selectIdContact -> execute();
            
            $listIdContact = $selectIdContact -> fetch();
            $contactsList[$index] = new Contact($listIdContact['fName'], $listIdContact['lName'], $listIdContact['email']);
            $index++;
        }
        return $contactsList;
    }

    public function username($email)
    {
        $selectStatement = $this->db->prepare("select firstName, lName from utilizatori where email = ?");
        $selectStatement->bindParam(1, $email, PDO::PARAM_INT);
        $selectStatement->execute();

        if ($selectStatement->rowCount()  === 1) {
            $firstRow = $selectStatement->fetch();
            return $firstRow['firstName'] . ' ' . $firstRow['lName'];
        }
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

class Contact {
    public $fName;
    public $lName;
    public $email;
    function __construct($fName, $lName, $email) {
        $this -> fName = $fName;
        $this -> lName = $lName;
        $this -> email = $email;
    }
}

?>