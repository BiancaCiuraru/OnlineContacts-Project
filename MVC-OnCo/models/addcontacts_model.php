<?php

class AddContacts_Model extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function nameValidity($fname, $lname){
        if(!preg_match("/[A-Za-z ]{1,32}/", $fname) || !preg_match("/[A-Za-z ]{1,32}/", $lname)){
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

        $selectStatement = $this->db -> prepare("select id_user from utilizatori where email = ?");
        $selectStatement -> bindParam(1, $_SESSION['emailLogin'], PDO::PARAM_STR);
        $selectStatement -> execute();
        $rez = $selectStatement->fetch();
        $id_user = $rez['id_user']; 
        
        $selectIdContact = $this->db -> prepare("select max(id_contact) from contact where id_user = ?");
        $selectIdContact -> bindParam(1, $id_user, PDO::PARAM_STR);
        $selectIdContact -> execute();
        $r = $selectIdContact->fetch();
        
        $id_contact = $r['max(id_contact)']+1; 

        $temp = explode(".", $_FILES["pic"]["name"]);
        $name = $temp[0] . $id_contact;
        $image = $name . "." . $temp[1];
        $target = "./public/images/" .$image; //folderul in care imi mut imaginea 

        move_uploaded_file($_FILES['pic']['tmp_name'], $target); //iau imaginea si o pun in folderul images pt ca mai apoi e nevoie de ea pt listarea contactelor

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

    public function getPhotoUser($email){
        $statement = $this->db->prepare("SELECT photo from utilizatori where email=?");
        $statement->bindParam(1, $email, PDO::PARAM_STR);
        $statement->execute();
        $rezultat = $statement->fetch();
        return $rezultat['photo'];
    }
}

?>