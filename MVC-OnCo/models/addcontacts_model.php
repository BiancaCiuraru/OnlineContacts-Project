<?php

class AddContacts_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function nameValidity($fname, $lname){
        if(!preg_match("/\A[A-Z][a-z]*\z/", $fname) || !preg_match("/\A[A-Z][a-z]*\z/", $lname)){
            return false;
        }else {
            return true;
        }
    }

    public function emailValidity($email){
        $selectStatement = $this->db -> prepare("select email from contact where email = ?");
        $selectStatement -> bindParam(1, $email, PDO::PARAM_STR);
        $selectStatement -> execute();
        $rez = $selectStatement->rowCount();
        return $rez;
    }

    public function addContact($fname, $lname, $bday, $phone, $email, $adress, $interests, $description){

        $target = "./public/images/" .basename($_FILES['pic']['name']); //folderul in care imi mut imaginea 
        $image = $_FILES['pic']['name'];

        move_uploaded_file($_FILES['pic']['tmp_name'], $target); //iau imaginea si o pun in folderul images pt ca mai apoi e nevoie de ea pt listarea contactelor

        $selectStatement = $this->db -> prepare("select id_user from utilizatori where email = ?");
        $selectStatement -> bindParam(1, $_SESSION['emailLogin'], PDO::PARAM_STR);
        $selectStatement -> execute();
        $rez = $selectStatement->fetch();
        
        $id_user = $rez['id_user']; 

        $insertStatementContact = $this->db -> prepare("INSERT INTO contact (fName, lName, birth_date, phone_number, photo, email, adress, descr, interests,id_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStatementContact -> bindParam(1, $fname, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(2, $lname, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(3, $bday, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(4, $phone, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(5, $image, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(6, $email, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(7, $adress, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(8, $description, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(9, $interests, PDO::PARAM_STR);
        $insertStatementContact -> bindParam(10, $id_user, PDO::PARAM_INT);
        $insertStatementContact -> execute();

        return true;
    }

    public function username($email)
    {
        $selectStatement = $this->db->prepare("select firstName, lName from utilizatori where email = ?");
        $selectStatement->bindParam(1, $email, PDO::PARAM_STR);
        $selectStatement->execute();

        if ($selectStatement->rowCount()  === 1) {
            $firstRow = $selectStatement->fetch();
            return $firstRow['firstName'] . ' ' . $firstRow['lName'];
        }
    }
}

?>