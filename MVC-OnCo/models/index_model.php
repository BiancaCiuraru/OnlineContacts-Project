<?php

class Index_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //listare contacte
    public function show_contacts($email)
    {
        $selectStatement = $this->db->prepare("select id_user from utilizatori where email = ?");
        $selectStatement->bindParam(1, $email, PDO::PARAM_STR);
        $selectStatement->execute();
        $rez = $selectStatement->fetch();
        $id_user = $rez['id_user'];

        $selectContact = $this->db->prepare("select * from contact where id_user = ?");
        $selectContact->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $contactIndex = array();
        $index = 0;

        for ($i = 1; $i <= $selectContact->rowCount(); $i++) {
            $rezultat = $selectContact->fetch();
            $contactIndex[$index] = new Contacts($rezultat['fName'], $rezultat['lName'], $rezultat['email'], $rezultat['photo'], $rezultat['phone_number'], $rezultat['birth_date'], $rezultat['adress'], $rezultat['descr'], $rezultat['interests']);
            $index++;
        }
        return $contactIndex;
    }

    //get username
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

    //vizualizarea detaliilor unui contact
    public function getUserID($email)
    {
        $selectStatement = $this->db->prepare("SELECT id_user from utilizatori where email = ?");
        $selectStatement->bindParam(1, $email, PDO::PARAM_STR);
        $selectStatement->execute();
        $result = $selectStatement->fetch();
        return $result['id_user'];
    }

    //get all the contacts of the logged user
    public function getContacts($email, $contactEmail)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select * from contact c where email = ? and id_user=?");
        $selectContact->bindParam(1, $contactEmail, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        if ($selectContact->rowCount()  === 1) { {
                $listContact = $selectContact->fetch();
                $contact = new Contacts($listContact['fName'], $listContact['lName'], $listContact['email'], $listContact['photo'], $listContact['phone_number'], $listContact['birth_date'], $listContact['adress'], $listContact['descr'], $listContact['interests']);
                return $contact;
            }
        }
    }

    public function exportCSV($email)
    {
        $id_user = $this->getUserID($email);

        $output = fopen("php://output", "w");
        fputcsv($output, array('Nume', 'Prenume', 'Data nastere', 'Email', 'Adresa', 'Descriere', 'Interese'));
        $selectContact = $this->db->prepare("select fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        while ($row = $selectContact->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        fclose($output);
        exit();
    }

    public function exportVCard($email)
    {

        $id_user = $this->getUserID($email);

        $selectContact = $this->db->prepare("select photo, fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectContact->execute();

        include("vcardexp.inc.php");
        $test = new vcardexp;
        for ($i = 0; $i < $selectContact->rowCount(); $i++) {
            $row = $selectContact->fetch(PDO::FETCH_ASSOC);
            $test->setValue("fName", $row['fName']);
            $test->setValue("lName", $row['lName']);
            $test->setValue("birth_date", $row['birth_date']);
            $test->setValue("email", $row['email']);
            $test->setValue("adress", $row['adress']);
            $test->setValue("descr", $row['descr']);
            $test->setValue("interests", $row['interests']);
            $test->setPicture($row['photo']);
            $test->copyPicture($row['photo']);
            $test->getCard();
        }
        exit();
    }

    public function exportAtom($email)
    {
        $id_user = $this->getUserID($email);
        $output = fopen("php://output", "w"); //sunt preluate datele
        $selectContact = $this->db->prepare("select fName, lName, birth_date, email, adress, descr, interests from contact where id_user = ?");
        $selectContact->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        header('Content-Type: text/txt');
        header('Content-Disposition: attachment; filename=data.txt');
        fputs($output, "<?xml version='1.0' encoding='iso-8859-1' >");

        fputs($output, '<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
        <title>Contacts</title>
        <author> 
			<name>Tiganescu Ana & Ciuraru Bianca</name>
		</author> ');
        while ($row = $selectContact->fetch(PDO::FETCH_ASSOC)) {
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

    //get group details of the logged user
    public function getGroups($email)
    {
        $id_user = $this->getUserID($email);
        $selectGroups = $this->db->prepare("select groupName, id_group from groups where id_user = ?");
        $selectGroups->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectGroups->execute();
        $groupsIndex = array();
        $index = 0;

        for ($i = 1; $i <= $selectGroups->rowCount(); $i++) {
            $rezultat = $selectGroups->fetch();
            $groupsIndex[$index] = new Groups($rezultat['groupName'], $rezultat['id_group']);
            $index++;
        }
        return $groupsIndex;
    }

    //edit contact photo
    public function updatePhoto($email, $emailModal)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $temp = explode(".", $_FILES["photoContact"]["name"]);
        $name = $temp[0] . $idContact;
        $image = $name . "." . $temp[1];
        $target = "./public/images/" . $image;

        move_uploaded_file($_FILES['photoContact']['tmp_name'], $target);

        $updateContacts = $this->db->prepare("UPDATE contact set photo =? where id_user=? and id_contact = ?");
        $updateContacts->bindParam(1, $image, PDO::PARAM_STR);
        $updateContacts->bindParam(2, $id_user, PDO::PARAM_INT);
        $updateContacts->bindParam(3, $idContact, PDO::PARAM_INT);
        $updateContacts->execute();
    }

    //edit contact first name
    public function updateFirstName($email, $emailModal, $fName)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $updateContacts = $this->db->prepare("UPDATE contact set fName=? where id_user=? and id_contact = ?");
        $updateContacts->bindParam(1, $fName, PDO::PARAM_STR);
        $updateContacts->bindParam(2, $id_user, PDO::PARAM_INT);
        $updateContacts->bindParam(3, $idContact, PDO::PARAM_INT);
        $updateContacts->execute();
    }

    //edit contact description
    public function updateDescription($email, $emailModal, $description)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $updateContacts = $this->db->prepare("UPDATE contact set descr=? where id_user=? and id_contact = ?");
        $updateContacts->bindParam(1, $description, PDO::PARAM_STR);
        $updateContacts->bindParam(2, $id_user, PDO::PARAM_INT);
        $updateContacts->bindParam(3, $idContact, PDO::PARAM_INT);
        $updateContacts->execute();
    }

    //edit contact interests
    public function updateInterests($email, $emailModal, $interests)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $updateContacts = $this->db->prepare("UPDATE contact set interests=? where id_user=? and id_contact = ?");
        $updateContacts->bindParam(1, $interests, PDO::PARAM_STR);
        $updateContacts->bindParam(2, $id_user, PDO::PARAM_INT);
        $updateContacts->bindParam(3, $idContact, PDO::PARAM_INT);
        $updateContacts->execute();
    }
    //edit contact adress
    public function updateAdress($email, $emailModal, $adress)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $updateContacts = $this->db->prepare("UPDATE contact set adress=? where id_user=? and id_contact = ?");
        $updateContacts->bindParam(1, $adress, PDO::PARAM_STR);
        $updateContacts->bindParam(2, $id_user, PDO::PARAM_INT);
        $updateContacts->bindParam(3, $idContact, PDO::PARAM_INT);
        $updateContacts->execute();
    }

    //add a given contact to a chosen group
    public function addToGroup($email, $emailModal, $idGroup)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select id_contact from contact where email = ? and id_user=?");
        $selectContact->bindParam(1, $emailModal, PDO::PARAM_STR);
        $selectContact->bindParam(2, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $result = $selectContact->fetch();
        $idContact = $result['id_contact'];

        $selectGroup = $this->db->prepare("select * from member where id_contact = ? and id_group=?");
        $selectGroup->bindParam(1, $idContact, PDO::PARAM_INT);
        $selectGroup->bindParam(2, $idGroup, PDO::PARAM_INT);
        $selectGroup->execute();

        if ($selectGroup->rowCount()> 0) {
            return false;
        } else {
            $addContact = $this->db->prepare("INSERT INTO member (id_contact, id_group) VALUES(?, ?)");
            $addContact->bindParam(1, $idContact, PDO::PARAM_INT);
            $addContact->bindParam(2, $idGroup, PDO::PARAM_INT);
            $addContact->execute();
            return true;
        }
    }

    //create xml file with all the contacts for each user 
    public function getContact($email)
    {
        $id_user = $this->getUserID($email);
        $selectContact = $this->db->prepare("select * from contact where id_user = ?");
        $selectContact->bindParam(1, $id_user, PDO::PARAM_INT);
        $selectContact->execute();
        $contactIndex = array();

        for ($i = 1; $i <= $selectContact->rowCount(); $i++) {
            $rezultat = $selectContact->fetch();
            array_push($contactIndex, $rezultat);
        }
        return $contactIndex;
    }

    public function xmlContact($contactIndex, $iduser)
    {
        $filePath = './xmlDocs/contacts-' . $iduser . '.xml';
        $dom = new DOMDocument('1.0', 'utf-8');
        $root = $dom->createElement('contacts');

        for ($i = 0; $i < count($contactIndex); $i++) {
            $contactId = $contactIndex[$i]['id_contact'];
            $contactFirstName =  htmlspecialchars($contactIndex[$i]['fName']);
            $contactLastName =  htmlspecialchars($contactIndex[$i]['lName']);
            $contactphoto = $contactIndex[$i]['photo'];
            $contactEmail = $contactIndex[$i]['email'];
            $contactBirthday = $contactIndex[$i]['birth_date'];
            $contactAdress = $contactIndex[$i]['adress'];
            $contactDescr = $contactIndex[$i]['descr'];
            $contactPhone = $contactIndex[$i]['phone_number'];
            $contactInterest = $contactIndex[$i]['interests'];
            $contactIdUser = $contactIndex[$i]['id_user'];

            $contact = $dom->createElement('contact');
            $contact->setAttribute('id_contact', $contactId);

            $firstName = $dom->createElement('firstName', $contactFirstName);
            $contact->appendChild($firstName);
            $lastName = $dom->createElement('lastName', $contactLastName);
            $contact->appendChild($lastName);
            $photo = $dom->createElement('photo', $contactphoto);
            $contact->appendChild($photo);
            $email = $dom->createElement('email', $contactEmail);
            $contact->appendChild($email);
            $birthday = $dom->createElement('birthday', $contactBirthday);
            $contact->appendChild($birthday);
            $adress = $dom->createElement('adress', $contactAdress);
            $contact->appendChild($adress);
            $description = $dom->createElement('description', $contactDescr);
            $contact->appendChild($description);
            $phone = $dom->createElement('phone', $contactPhone);
            $contact->appendChild($phone);
            $interests = $dom->createElement('interests', $contactInterest);
            $contact->appendChild($interests);
            $idUser = $dom->createElement('idUser', $contactIdUser);
            $contact->appendChild($idUser);
            $root->appendChild($contact);
        }

        $dom->appendChild($root);
        $dom->save($filePath);
    }


    public function editProfilePhoto($session_email)
    {
        $id_user = $this->getUserID($session_email);
        $temp = explode(".", $_FILES["photoU"]["name"]);
        $name = $temp[0] . $id_user;
        $image = $name . "." . $temp[1];
        $target = "./public/images/" . $image;

        move_uploaded_file($_FILES['photoU']['tmp_name'], $target);

        $insertStatement = $this->db->prepare("UPDATE utilizatori set photo=? WHERE id_user = ? ");
        $insertStatement->bindParam(1, $image, PDO::PARAM_STR);
        $insertStatement->bindParam(2, $id_user, PDO::PARAM_INT);
        $insertStatement->execute();
    }

    public function editProfileEmail($session_email, $email)
    {
        $id_user = $this->getUserID($session_email);

        $insertStatement = $this->db->prepare("UPDATE utilizatori set email=? WHERE id_user = ? ");
        $insertStatement->bindParam(1, $email, PDO::PARAM_STR);
        $insertStatement->bindParam(2, $id_user, PDO::PARAM_INT);
        $insertStatement->execute();
        return true;
    }

    public function editProfilePass($session_email, $password1)
    {
        $id_user = $this->getUserID($session_email);
        $hashedPassword1 = md5($password1);

        $insertStatement = $this->db->prepare("UPDATE utilizatori set pass=? WHERE id_user = ? ");
        $insertStatement->bindParam(1, $hashedPassword1, PDO::PARAM_STR);
        $insertStatement->bindParam(2, $id_user, PDO::PARAM_INT);
        $insertStatement->execute();
        return true;
    }

    public function getPhotoUser($email){
        $statement = $this->db->prepare("SELECT photo from utilizatori where email=?");
        $statement->bindParam(1, $email, PDO::PARAM_STR);
        $statement->execute();
        $rezultat = $statement->fetch();
        return $rezultat['photo'];
    }

}

class Groups
{
    public $nameGroup;
    public $idGroup;
    function __construct($nameGroup, $idGroup)
    {
        $this->nameGroup = $nameGroup;
        $this->idGroup = $idGroup;
    }
}

class Contacts
{
    public $firstName;
    public $lastName;
    public $photo;
    public $email;
    public $birthday;
    public $adress;
    public $description;
    public $interests;
    public $phone_number;
    function __construct($firstName, $lastName, $email, $photo, $phone_number, $birthday, $adress, $description, $interests)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->photo = $photo;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->adress = $adress;
        $this->description = $description;
        $this->interests = $interests;
    }
}
