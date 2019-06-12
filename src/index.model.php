<?php
    class IndexModel{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "onco_db";
        private $conn;

        public function __construct(){
            $this->conn= new mysqli($this->servername, $this->username, $this->password, $this->db);
        }

        public function show_contacts($email)
        {
            $selectStatement = $this->conn->prepare("select id_user from utilizatori where email = ?");
            $selectStatement->bind_param("s", $email);
            $selectStatement->execute();
            $result = $selectStatement->get_result();
            $rez = $result->fetch_assoc();
            $id_user = $rez['id_user'];
    
            $selectContact = $this->conn->prepare("select * from contact where id_user = ?");
            $selectContact->bind_param("i", $id_user);
            $selectContact->execute();
            $contactIndex = array();
    
            $contacts = $selectContact->get_result();
            $index = 0;
    
            for ($i = 1; $i <= $contacts->num_rows; $i++) {
                $rezultat = $contacts->fetch_assoc();
                $contactIndex[$index] = new Contacts($rezultat['fName'], $rezultat['lName'], $rezultat['email'], $rezultat['photo'], $rezultat['phone_number'], $rezultat['birth_date'], $rezultat['adress'], $rezultat['descr'], $rezultat['interests']);
                $index++;
            }
            return $contactIndex;
        }

        public function alphabet_filter($email, $character){
            $selectStatement = $this->conn->prepare("select id_user from utilizatori where email = ?");
            $selectStatement->bind_param("s", $email);
            $selectStatement->execute();
            $result = $selectStatement->get_result();
            $rez = $result->fetch_assoc();
            $id_user = $rez['id_user'];
    
            $selectContact = $this->conn->prepare("select * from contact where id_user = ? and fName like ?% or lName like ?%;");
            $selectContact->bind_param("i", $id_user, $character, $character);
            $selectContact->execute();
            $contactIndex = array();
    
            $contacts = $selectContact->get_result();
            $index = 0;
    
            for ($i = 1; $i <= $contacts->num_rows; $i++) {
                $rezultat = $contacts->fetch_assoc();
                $contacts[index]= new Contacts($rezultat['fName'], $rezultat['lName'], $rezultat['email'], $rezultat['photo'], $rezultat['phone_number'], $rezultat['birth_date'], $rezultat['adress'], $rezultat['descr'], $rezultat['interests']);
                $index++;
            }
            return $contactIndex;
        }

        public function username($email){
            $selectStatement = $this->conn->prepare("select firstName, lName from utilizatori where email = ?");
            $selectStatement->bind_param("s",$email);
            $selectStatement->execute();
            $results = $selectStatement -> get_result();
            $selectStatement -> close();

            if($results -> num_rows  === 1) {
                $firstRow = $results -> fetch_assoc();
                return $firstRow['firstName'].' '. $firstRow['lName'];
            } 
        }

        //vizualizarea detaliilor unui contact
        public function getUserID($email){
            $selectStatement = $this->conn -> prepare("select id_user from utilizatori where email = ?");
            $selectStatement -> bind_param("s", $email);
            $selectStatement -> execute();
            $selectStatement -> bind_result($result);
            $selectStatement -> fetch();
            return $result;
        }

    public function getContacts($email, $contactEmail){
        $id_user = $this->getUserID($email);
        $selectContact = $this->conn -> prepare("select * from contact c where email = ? and id_user=?");
        $selectContact -> bind_param("si", $contactEmail, $id_user);
        $selectContact -> execute();
        $resultContact = $selectContact -> get_result();
        $selectContact -> close();

        if($resultContact -> num_rows  === 1) {
        {
            $listContact = $resultContact -> fetch_assoc();
            $contact= new Contacts($listContact['fName'], $listContact['lName'], $listContact['email'], $listContact['photo'], $listContact['phone_number'], $listContact['birth_date'], $listContact['adress'], $listContact['descr'], $listContact['interests']);
            return $contact;
        }    
    } }}
    
    class Contacts {
        public $firstName;
        public $lastName;
        public $photo;
        public $email;
        public $birthday;
        public $adress;
        public $description;
        public $interests;
        public $phone_number;
        function __construct($firstName, $lastName, $email, $photo, $phone_number, $birthday, $adress,$description,$interests) {
          
            $this -> firstName = $firstName;
            $this -> lastName = $lastName;
            $this -> photo = $photo;
            $this -> phone_number = $phone_number;
            $this -> email = $email;
            $this -> birthday = $birthday;
            $this -> adress = $adress;
            $this -> description = $description;
            $this -> interests = $interests;
        }
    }