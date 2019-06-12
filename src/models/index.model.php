<?php
    class IndexModel{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $db = "test";
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
    } }

    public function exportCSV($email){
        $id_user = $this->getUserID($email);

        $output = fopen("php://output", "w");
        fputcsv($output, array('Nume', 'Prenume', 'Data nastere','Email', 'Adresa', 'Descriere', 'Interese'));
        $selectContact = $this->conn -> prepare("select fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact -> bind_param("i", $id_user);
        $selectContact -> execute();
        $resultContact = $selectContact -> get_result();
        while($row = mysqli_fetch_assoc($resultContact)){
            fputcsv($output, $row);
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        fclose($output);
        exit();
    }

    public function exportVCard($email){
        
        $id_user = $this->getUserID($email);

        $selectContact = $this->conn -> prepare("select photo, fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact -> bind_param("i", $id_user);
        $selectContact -> execute();
        $resultContact = $selectContact -> get_result();

        include("vcardexp.inc.php");
        $test = new vcardexp;
        for($i=0; $i<$resultContact->num_rows;$i++){
            $row = mysqli_fetch_assoc($resultContact);
            $test->setValue("fName", $row['fName']);
            $test->setValue("lName", $row['lName']);
            $test->setValue("birth_date", $row['birth_date']);
            $test->setValue("email", $row['email']);
            $test->setValue("adress", $row['adress']);
            $test->setValue("descr", $row['descr']);
            $test->setValue("interests", $row['interests']);
            $test -> setPicture($row['photo']);
            $test->copyPicture($row['photo']);
            $test->getCard();
        }
        exit();
    }

    public function exportAtom($email){
        $id_user = $this->getUserID($email);
        $output = fopen("php://output", "w"); //sunt preluate datele
        $selectContact = $this->conn -> prepare("select fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact -> bind_param("i", $id_user);
        $selectContact -> execute();
        $resultContact = $selectContact -> get_result();
        header('Content-Type: text/xml');
        header('Content-Disposition: attachment; filename=data.xml');
        fputs($output, "<?xml version='1.0' encoding='iso-8859-1' >");

         fputs($output, '<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
        <title>Contacts</title>
        <author> 
			<name>Tiganescu Ana & Ciuraru Bianca</name>
		</author> ');
          while($row = mysqli_fetch_assoc($resultContact))
            {
            fputs($output, "<entry><Nume> ");
            fputs($output, $row['fName']);
            fputs($output, " </Nume>");

            fputs($output, "<Prenume> ");
            fputs($output, $row['lName']);
            fputs($output, " </Prenume>");

            fputs($output, "<Zi de nastere> ");
            fputs($output, $row['birth_date']);
            fputs($output, " </Zi de nastere>");

            fputs($output, "<Email> ");
            fputs($output, $row['email']);
            fputs($output, " </Email>");

            fputs($output, "<Adresa> ");
            fputs($output, $row['adress']);
            fputs($output, " </Adresa>");

            fputs($output, "<Descriere> ");
            fputs($output, $row['descr']);
            fputs($output, " </Descriere>");

            fputs($output, "<Interese> ");
            fputs($output, $row['interests']);
            fputs($output, " </Interese></entry>");
          }			
          fputs($output, "</entry></feed>");

        fclose($output);
        exit();
    }

}
    
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