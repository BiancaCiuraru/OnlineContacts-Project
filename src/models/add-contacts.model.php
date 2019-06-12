<?php

class AddContactsModel{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "test";
    private $conn;

    public function __construct(){
        $this->conn= new mysqli($this->servername, $this->username, $this->password, $this->db);
    }

    public function nameValidity($fname, $lname){
        if(!preg_match("/\A[A-Z][a-z]*\z/", $fname) || !preg_match("/\A[A-Z][a-z]*\z/", $lname)){
            return false;
        }else {
            return true;
        }
    }

    public function emailValidity($email){
        $selectStatement = $this->conn -> prepare("select email from contact where email = ?");
        $selectStatement -> bind_param("s", $email);
        $selectStatement -> execute();
        $result = $selectStatement -> get_result();

        $rez = $result->num_rows;
        return $rez;
    }

    public function addContact($fname, $lname, $bday, $phone, $email, $adress, $interests, $description){

        $target = "../images/" .basename($_FILES['pic']['name']); //folderul in care imi mut imaginea 
        $image = $_FILES['pic']['name'];

        move_uploaded_file($_FILES['pic']['tmp_name'], $target); //iau imaginea si o pun in folderul images pt ca mai apoi e nevoie de ea pt listarea contactelor

        $selectStatement = $this->conn -> prepare("select id_user from utilizatori where email = ?");
        $selectStatement -> bind_param("s", $_SESSION['emailLogin']);
        $selectStatement -> execute();
        $result = $selectStatement -> get_result();
        $rez = $result->fetch_assoc();
        
        $id_user = $rez['id_user']; 

        $insertStatementContact = $this->conn -> prepare("INSERT INTO contact (fName, lName, birth_date, phone_number, photo, email, adress, descr, interests,id_user) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStatementContact -> bind_param("sssssssssi", $fname, $lname, $bday, $phone, $image, $email, $adress, $description, $interests, $id_user);
        $insertStatementContact -> execute();
        $insertStatementContact -> close();

        return true;
    }
}

?>